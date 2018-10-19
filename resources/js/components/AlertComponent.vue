<template>
    <div>
        <div v-if="type_display == 1" class="alert alert-min alert-primary active" :class="{
            'out': show === false,
        }">
            <img class="loading-gif" src="/images/loading.gif"> <span>Guardando...</span>
        </div>

        <div v-if="type_display == 2" class="alert alert-min alert-success" :class="{
            'out': show === false,
        }">
            <i class="fa fa-check" aria-hidden="true"></i> <span>!Guardado!</span>
        </div>

        <div v-if="type_display == 3" class="alert alert-min alert-danger" :class="{
            'out': show === false,
        }">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>Error :c</span>
        </div>

        <div v-if="type_display == 4" class="alert alert-min alert-primary active" :class="{
            'out': show === false,
        }">
            <img class="loading-gif" src="/images/loading.gif"> <span>Cargando...</span>
        </div>

        <div v-if="type_display == 5" class="alert alert-min alert-success" :class="{
            'out': show === false,
        }">
            <i class="fa fa-check" aria-hidden="true"></i> <span>!Cargado!</span>
        </div>

        <div v-if="type_display == 6" class="alert alert-min alert-primary active" :class="{
            'out': show === false,
        }">
            <img class="loading-gif" src="/images/loading.gif"> <span>Buscando...</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'type' ],
        data() {
            return {
                type_display: null,
                show: null,
            }
        },
        methods: {
            setAlertState(state) {
                setTimeout(() => {
                    this.state = state;

                    setTimeout(() => {
                        this.state = 0;

                        setTimeout(() => {
                            this.state = null;
                        }, 300);
                    }, 300);
                }, 300);
            },
        },
        watch: {
            'type': function(newValue, oldValue) {
                if (newValue == 1 || newValue == 4 || newValue == 6) {
                    this.type_display = newValue;
                }

                if (newValue > 1) {
                    var vm = this;

                    setTimeout(() => {
                        vm.type_display = newValue;

                        setTimeout(() => {
                            vm.show = false;

                            setTimeout(() => {
                                vm.type_display = null;
                                vm.show = null;
                            }, 600);
                        }, 600);
                    }, 1000);
                }
            },
        }
    }
</script>
