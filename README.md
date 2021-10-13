# Restrict Fields

> Restrict Fields is a Statamic addon that allows you to restrict fields in the control panel to certain users, groups or roles.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require thoughtco/statamic-restrict-fields
```

## How to Use

Once installed, 3 new custom condition methods become available to use:

### restrictUsers

Use with a value in the format:
`restrictUsers:user_id_1,user_id_2`

### restrictGroups

Use with a value in the format:
`restrictGroups:group_slug_1,group_slug_2`

### restrictRoles

Use with a value in the format:
`restrictRoles:role_slug_1,role_slug_2`