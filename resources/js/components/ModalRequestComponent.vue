<script>
  export default {
    name: 'modal_component',
    data() {
        return {
            amount: 0,
            age: 0,
            credit_card: false,
            terms: [],
            term: null,
            total_amount: 0,
            term_id: 0,
            percent_term: 0,
            alert: {
                type: null,
                state: null,
            },
        }
    },
    mounted() {
        this.getOptionTerms();
    },
    methods: {
        close() {
            this.amount = 0;
            this.age = 0;
            this.credit_card = false;
            this.term = null;
            this.total_amount = 0;
            this.term_id = 0;
            this.percent_term = 0;
            this.$emit('close');
        },
        getOptionTerms() {
            var vm = this;
            axios.get(`/terms`)
            .then(function (response) {
                vm.terms = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        calculateTotal() {
            if(Number.isInteger(this.term)) {
                var interest = 0;

                interest = (this.amount * (this.percent_term)/100) * this.terms[this.term].term;

                this.total_amount = this.amount + interest;
            } else {
                this.total_amount = 0;
            }
        },
        saveRequest() {
            var vm = this;
            vm.alertType(1);
            axios.post(`/request`,{
                amount: this.amount,
                age: this.age,
                credit_card: this.credit_card,
                term_id: this.terms[this.term] ? this.terms[this.term].id:null,
                total_amount: this.total_amount,
            })
            .then(function (response) {
                vm.alertType(2);
                Event.$emit('reload-data');
                vm.close();
            })
            .catch(function (error) {
                vm.alertType(3);
            });
        },
        alertType(type) {
            this.alert.type = type;
        },
    },
    watch: {
        term: function(value) {
            if(this.terms[value]) {
                this.term_id = this.terms[value].id;
                this.percent_term = this.terms[value].percent;  
            }
            
            this.calculateTotal();
        },
    },
  };
</script>
<template>
    <div class="modal-backdrop">
      <div class="modal"
        role="dialog"
        aria-labelledby="modalTitle"
        aria-describedby="modalDescription"
      >
        <header
          class="modal-header"
          id="modalTitle"
        >
          <slot name="header">
            Nueva Solicitud
            <button
              type="button"
              class="btn-close"
              @click="close"
              aria-label="Close modal"
            >
              x
            </button>
          </slot>
        </header>
        <section
          class="modal-body"
          id="modalDescription"
        >
            <div>
                <span>Monto: </span>
                <br>
                <vue-numeric currency="$"
                    separator=","
                    :min = "0"
                    v-model="amount"
                    :precision="2"
                    :blur="calculateTotal()"
                ></vue-numeric>
            </div>
            <div>
                <span>Edad: </span>
                <br>
                <vue-numeric currency=""
                    :max="120"
                    :min="0"
                    v-model="age"
                ></vue-numeric>
            </div>
            <div>
                <span>Tarjeta de Crédito: </span>
                <input type="checkbox" v-model="credit_card">
            </div>
            <div>
                <span>Plazo: </span>
                <select v-model="term">
                    <option v-for="(row, index) in terms" :value="index">{{row.description}}</option>
                </select>
            </div>
            <div>
                <span>Total a pagar: </span>
                <vue-numeric currency="$"
                    v-model="total_amount"
                    :read-only="true"
                    separator=","
                    :precision="2"
                ></vue-numeric>
            </div>
            <!--<input type="text" name="" value="tarjeta de credito">-->
        </section>
        <footer class="modal-footer">
          <slot name="footer">
          <alert :type="alert.type"></alert>
            <button class = "btn"
                @click="saveRequest">
                Solicitar
            </button>
          </slot>
        </footer>
      </div>
    </div>
</template>