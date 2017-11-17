<template>
    <tr>
        <td>
            <input type="hidden" :name="'prices[' + index + '][id]'" :value="id" v-if="id"/>
            <input type="number" v-model="price" :name="'prices[' + index + '][price]'"/>
        </td>
        <td>
            <input type="text" v-model="label" :name="'prices[' + index + '][label]'"/>
        </td>
        <td>
            <input type="radio" :checked="currentprice" @change="$emit('check', index)" name="check_currentprice" required/>
            <input type="hidden" :value="currentprice" :name="'prices[' + index + '][selected]'" required/>
        </td>
        <td><a href="#" class="btn btn-danger btn-sm" v-if="canBeDeleted" @click.prevent="$emit('remove', index)">Usuń cenę</a></td>
    </tr>
</template>

<script>
    export default {
        props: {
            attributes: {type: Object},
            canBeDeleted: {type: Boolean, default: false},
            index: {type: Number},
        },
        data: function() {
            return {
                price: this.attributes.price,
                label: this.attributes.label
            }
        },
        computed: {
            currentprice: function () {
                return this.attributes.selected ? this.attributes.selected : 0;
            },
            id: function () {
                return this.attributes.id;
            }
        }
    }
</script>
