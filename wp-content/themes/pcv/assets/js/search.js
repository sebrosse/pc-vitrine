function pcvSearchProducts(term) {
    return pcvAjax('search_products', {'term': term}).then((response) => {
        return response.data;
    });
}

function pcvSearchPosts(term) {
    return pcvAjax('search_posts', {'term': term}).then((response) => {
        return response.data;
    });
}

const postsPlugin = {
    getSources() {
        return [
            {
                sourceId: 'posts',
                getItems({query}) {
                    return pcvSearchPosts(query);

                },
                getItemUrl({item}) {
                    return item.url;
                },
                templates: {
                    header({state, html}) {

                        return html`
                            <span className="aa-SourceHeaderTitle">Articles</span>
                            <div className="aa-SourceHeaderLine"/>`;
                    },
                    item({item, html}) {
                        return html`
                            <div>${item.name}</div>`;
                    },
                },
            },
        ];
    },
};

const productsPlugin = {
    getSources() {
        return [
            {
                sourceId: 'products',
                getItems({query}) {
                    return pcvSearchProducts(query);

                },
                getItemUrl({item}) {
                    return item.url;
                },
                templates: {
                    header({state, html}) {

                        return html`
                            <span className="aa-SourceHeaderTitle">Produits</span>
                            <div className="aa-SourceHeaderLine"/>`;
                    },
                    item({item, html}) {
                        return html`
                            <div class="aa-ItemWrapper" data-url="${item.url}">
                                <div class="aa-ItemContent">
                                    <div class="aa-ItemIcon aa-ItemIcon--noBorder">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path>
                                        </svg>
                                    </div>
                                    <div class="aa-ItemIcon aa-ItemIcon--alignTop">
                                        <img src="${item.thumbnail}" width="45" height="45"/>
                                    </div>
                                    <div class="aa-ItemContentBody">
                                        <div class="aa-ItemContentTitle">
                                            ${item.name}
                                        </div>
                                    </div>
                                </div>
                                <div class="aa-ItemActions">
                                    <span style="color: green; font-size: 0.9em; font-weight: bold;margin-right: 8px">${item.price}</span>
                                </div>
                            </div>`;
                    },
                }
            },
        ];
    },
};


jQuery(document).ready(function ($) {
    if ($('#autocomplete').length > 0) {
        const {autocomplete} = window['@algolia/autocomplete-js'];
        autocomplete({
            container: '#autocomplete',
            placeholder: 'Que recherchez-vous ?',
            debug: true,
            plugins: [postsPlugin, productsPlugin],
        });
    }
})
