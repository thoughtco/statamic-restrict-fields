# Restrict Fields

> Restrict Fields is a Statamic addon that allows you to restrict fields in the control panel to certain users or groups

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require thoughtco/restrict-fields
```

## How to Use

Once installed, add an array of `restrict_to_users` or `restrict_to_groups` to your blueprint YAML.

e.g.

```
        handle: template
        field:
          type: template
          display: Template
          localizable: true
          restrict_to_users:
            - "a9368c46c-adfc-43c3-b6b5-6a552f60187c"
            - "b9368c46c-adfc-43c3-b6b5-6a552f60187d"
```

Note: `restrict_to_users` takes preference over `restrict_to_groups` so if both are present, groups will be ignored.