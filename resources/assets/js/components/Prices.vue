<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Cena</th>
                <th>Opis</th>
                <th>Aktualna</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(price, index) in prices"
                is="price"
                :can-be-deleted="prices.length > 1"
                :key="price.uuid"
                :index="index"
                :attributes="price"
                @remove="remove"
                @check="check"
            ></tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <a href="#" class="btn btn-xs btn-primary" @click.prevent="addItem">Dodaj cenę</a>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            items: {type: Array, default: () => []}
        },
        data() {
            return {
                prices: this.items
            }
        },
        components: {
            'price': require('./Price.vue')
        },
        methods: {
            addItem() {
                this.prices.push({uuid: Date.now() + '_' + Math.floor((Math.random() * 10000000) + 1)});
            },

            remove(index) {
                this.prices.splice(index, 1);
            },
            check: function (index) {
                for (var i = 0, x = this.prices.length; i < x; i++) {
                    this.$set(this.prices[i], 'selected', i == index);
                }
            }
        },
        created: function () {

            for (var i = 0, x = this.prices.length; i < x; i++) {
                this.prices[0].uuid = Date.now() + '_' + Math.floor((Math.random() * 10000000) + 1);
            }

            if (this.prices.length == 0) {
                this.addItem();
            }
        }
    }
</script>
