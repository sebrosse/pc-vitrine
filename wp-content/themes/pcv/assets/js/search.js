var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            borderRadius: 20,
            data: data,
            backgroundColor: [
                'rgba(0, 0, 0, 0.15)'
            ],
            hoverBackgroundColor: [
                'rgba(0, 0, 0, 0.35)'
            ],
            borderColor: [
                'rgba(255,255,255,100)'
            ],
            borderWidth: 1

        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                display: false,
                grid: {
                    display: false
                }
            },
            y: {
                display: false,
                grid: {
                    display: false
                }
            }
        }
    }
});

const {autocomplete} = window['@algolia/autocomplete-js'];
autocomplete({
    container: '#autocomplete',
    placeholder: 'Quel produit recherchez-vous ?',
    debug: true,
    //plugins: [querySuggestionsPlugin],
    getSources() {
        return [
            {
                sourceId: 'links',
                getItems({query}) {
                    const items = [
                        {name: 'Twitter', label: 'Twitter', url: 'https://twitter.com'},
                        {name: 'GitHub', label: 'GitHub', url: 'https://github.com'},
                    ];

                    return items.filter(({label}) =>
                        label.toLowerCase().includes(query.toLowerCase())
                    );
                },
                getItemUrl({item}) {
                    return item.url;
                },
                templates: {
                    item({item, html}) {
                        return html`
                            <div>Result: ${item.name}</div>`;
                    },
                },
            },
        ];
    },
});
