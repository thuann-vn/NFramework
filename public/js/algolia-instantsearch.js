(function() {
    const search = instantsearch({
        appId: '5R1L0G38JG',
        apiKey: '547ce5d98108c2b5b19e37e91073fb75',
        indexName: 'products',
        urlSync: true
    });

    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            templates: {
                empty: 'No results',
                item: function(item) {
                    return  `<div class="product">
                                <a href="${window.location.origin}/product/${item.slug}">
                                   <img src="${window.location.origin}/storage/${item.image}" alt="img" class="algolia-thumb-result">
                                </a>
                                <div class="product-info">
                                    <a href="${window.location.origin}/product/${item.slug}">
                                        <div class="product-name">${item.name}</div>
                                    </a>`
                                    +((item.regular_price)?`<div class="product-regular-price">${ parseInt(item.regular_price).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}₫</div>`:``)+
                                    `<div class="product-price">${ parseInt(item.price).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}₫</div>
                                </div>
                            </div>`;
                }
            }
        })
    );

    // initialize SearchBox
    // search.addWidget(
    //     instantsearch.widgets.searchBox({
    //         container: '#search-box',
    //         placeholder: 'Search for products'
    //     })
    // );

    // initialize pagination
    search.addWidget(
        instantsearch.widgets.pagination({
            container: '#pagination',
            maxPages: 20,
            // default is to scroll to 'body', here we disable this behavior
            scrollTo: false
        })
    );

    search.addWidget(
        instantsearch.widgets.stats({
            container: '#stats-container'
        })
    );

    // initialize RefinementList
    // search.addWidget(
    //     instantsearch.widgets.refinementList({
    //         container: '#refinement-list',
    //         attributeName: 'categories',
    //         sortBy: ['name:asc']
    //     })
    // );

    search.start();
})();
