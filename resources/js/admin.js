window.admin = {
    name: 'PinAdmin',
    version: '0.0.1',
    statuses: {},
    stores: {},
}

admin.set = (key, value) => {
    Vue.set(admin.stores, key, value)
}

admin.get = (key, def) => {
    return typeof admin.stores[key] === 'undefined' ? def : admin.stores[key]
}

admin.setTrue = (key) => {
    Vue.set(admin.statuses, key, true)
}

admin.setFalse = (key) => {
    Vue.set(admin.statuses, key, false)
}

admin.message = ElementUI.Message

console.log(
    `%c ${admin.name} %c v${admin.version} %c`,
    'background:#0099e5 ; padding: 1px; border-radius: 3px 0 0 3px;  color: #fff',
    'background:#34bf49 ; padding: 1px; border-radius: 0 3px 3px 0;  color: #fff',
    'background:transparent'
)