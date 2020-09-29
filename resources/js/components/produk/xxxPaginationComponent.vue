<template>
    <div class="card text-center m-3">
        <h3 class="card-header">Vue.js Pagination Tutorial & Example</h3>
        <div class="card-body">
            <div v-for="item in pageOfItems" :key="item.id">{{item.name}}</div>
        </div>
        <div class="card-footer pb-0 pt-3">
            <jw-pagination :items="products" @changePage="onChangePage" :labels="customLabels"></jw-pagination>
        </div>
    </div>
</template>

<script>
const customStyles = {
    ul: {
        border: '2px solid red'
    },
    li: {
        display: 'inline-block',
        border: '2px dotted green'
    },
    a: {
        color: 'blue'
    }
};
const customLabels = {
    first: '<<',
    last: '>>',
    previous: '<',
    next: '>'
};
// an example array of items to be paged
const exampleItems = [...Array(200).keys()].map(i => ({ id: (i+1), name: 'Item ' + (i+1) }));

export default {
    data() {
        return {
            products:[],
            customStyles,
            customLabels,
            // exampleItems,
            pageOfItems: []
        };
    },
    methods: {
        onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        },
        getProducts(page) {
        if (typeof page === 'undefined') {
          page = 1;
        }

        axios.get('api/products', {
          params: {
            page: page
          }
        }).then(data => {
          this.products = data.data;
        });     
      },
    }
};
</script>