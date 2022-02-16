
Statamic.$conditions.add('restrictUsers', function ({ target, params, store, storeName, values }) {
    return Statamic.user.super || params.includes(Statamic.user.id);
});

Statamic.$conditions.add('restrictGroups', function ({ target, params, store, storeName, values }) {
    return Statamic.user.super || params.filter(value => Statamic.user.groups.includes(value)).length > 0;
});

Statamic.$conditions.add('restrictRoles', function ({ target, params, store, storeName, values }) {
    return Statamic.user.super || params.filter(value => Statamic.user.roles.includes(value)).length > 0;
});
