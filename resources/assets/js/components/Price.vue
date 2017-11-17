<template>
    <tr>
        <td>
            <input type="number" v-model="value" :name="'prices[' + index + '][value]'"/>
        </td>
        <td>
            <input type="text" v-model="description" :name="'prices[' + index + '][description]'"/>
        </td>
        <td>
            <input type="radio" :checked="currentprice" @change="$emit('check', index)" name="check_currentprice" required/>
            <input type="hidden" :value="currentprice" :name="'prices[' + index + '][currentprice]'" required/>
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
                value: this.attributes.value,
                description: this.attributes.description
            }
        },
        computed: {
            currentprice: function () {
                return this.attributes.currentprice;
            }
        }
    }
</script>
