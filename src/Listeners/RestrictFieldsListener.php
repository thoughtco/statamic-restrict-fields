<?php

namespace Thoughtco\RestrictFields\Listeners;

use Illuminate\Support\Arr;
use Statamic\Events\EntryBlueprintFound;
use Statamic\Statamic;

class RestrictFieldsListener
{
    public function handle(EntryBlueprintFound $event)
    {
        if (!Statamic::isCpRoute())
        	return;		
		
		if (!$event->entry)
			return;
						
		$this->userId = auth()->user()->id();
		$this->userGroups = auth()->user()->groups()->pluck('handle');
		
		$contents = $event->blueprint->contents();
		foreach ($contents['sections'] as $sectionHandle => $section) {
			foreach ($section['fields'] as $fieldIndex => $field) {
				
				$field = $this->checkField($field);

				if (!$field) {
					unset($contents['sections'][$sectionHandle]['fields'][$fieldIndex]);
					continue;
				}
	
				$contents['sections'][$sectionHandle]['fields'][$fieldIndex] = $field;
			}
		}
		
		$event->blueprint->setContents($contents);
    }
	
	private function checkField($field)
	{
		$fieldConfig = $field['field'] ?? [];
		if (!$fieldConfig)
			return $field;
		
		if ($this->shouldRemoveField($fieldConfig))
			return false;
		
		// recurse over any sets (replicator)
		if ($sets = Arr::get($fieldConfig, 'sets', [])) {
			$fieldConfig['sets'] = $this->checkSets($sets);
			$field['field'] = $fieldConfig;
		}
		
		return $field;
						
	}
	
	private function checkSets($sets)
	{
		foreach ($sets as $index => $set) {
			$fields = $set['fields'];

			foreach ($fields as $fieldIndex => $field) {
				
				if (!isset($field['field']))
					continue;

				if ($this->shouldRemoveField($field['field'])) {
					unset($fields[$fieldIndex]);
					continue;
				}
					
				if ($childSets = Arr::get($field, 'field.sets', [])) {
					$field['field']['sets'] = $this->checkSets($childSets);
				}
			}	
	
			$sets[$index]['fields'] = $fields;
		}

		return $sets;	
	}
	
	private function shouldRemoveField($fieldConfig)
	{
		if ($restrictUsers = Arr::get($fieldConfig, 'restrict_to_users', []))
			if (!in_array($this->userId, $restrictUsers))
				return true;
				
		if ($restrictGroups = Arr::get($fieldConfig, 'restrict_to_groups', []))
			if (!array_intersect($this->userGroups, $restrictGroups))
				return true;
		
		return false;
	}
}

?>
