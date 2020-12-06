@extends(admin_template('viewless.layout'))

@section('content')
    <div id="app" class="p-5">
        {!! $contents !!}
    </div>

    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    builders: @json($builders),
                    data: @json($data),
                    controllerName: '{{ $controllerName }}',
                }
            },
            methods: {
                setProperty(builderId, name, value) {
                    this.builders[builderId].properties[name] = value
                },

                getProperty(builderId, name) {
                    return this.builders[builderId].properties[name]
                },

                setConfig(builderId, name, value) {
                    this.builders[builderId].configs[name] = value
                },

                getConfig(builderId, name) {
                    return this.builders[builderId].configs[name]
                },

                onAddButtonClick() {
                    this.setProperty('dialog', 'visible', true)
                },

                refreshLists(){
                    this.$http.get(this.controllerName + '/lists', {
                        label: 'refresh',
                        params: {
                            pageable: this.getConfig('table', 'lists').pageable,
                            page: this.getConfig('table', 'lists').page,
                            size: this.getConfig('table', 'lists').size,
                        }
                    }).then(res => {
                        this.setConfig('table', 'lists', res.data.lists)
                    })
                },

                onRefreshButtonClick() {
                    this.refreshLists()
                },

                onFormSave() {
                    this.$refs[this.builders.form.ref].validate(valid=>{
                        if (valid){
                            this.$http.post(this.controllerName, this.getConfig('form', 'data'), {label: 'save'}).then(res=>{
                                this.refreshLists()
                            })
                        } else {
                            this.$message.warning('表单验证失败')
                        }
                    })
                },


            },

            created() {
                this.refreshLists()
            },
        })
    </script>
@endsection

@section('style')

@endsection