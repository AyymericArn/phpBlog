export default class Search {
    constructor(rootPath) {
        this.$searchBar = document.querySelector('.search-bar');
        this.$searchResults = document.querySelector('.search-results');

        this.rootPath = rootPath;

        this.bindSearch();
    }

    bindSearch() {
        this.$searchBar.addEventListener('input', (_e) => {

            [...this.$searchResults.children].forEach(child => {
                child.remove();
            })

            const query = _e.target.value;

            if (query !== '') {

                fetch(`${this.rootPath}model/async/api?query=${query}`)
                .then(_res => _res.json())
                .then(_result => {
                    const results = _result;
    
                    // $searchResults.children.forEach(element => {
                    //     element.remove();
                    // });
                    
                    results[0].forEach(result => {
    
                        const resultLink = document.createElement('a');
                        resultLink.textContent = result.title;
                        resultLink.href = `./articles/${result.id}`;
                        this.$searchResults.appendChild(resultLink);
                    });

                    if (results[0].length > 0) {
                        this.$searchResults.style.display = 'block';                      
                    }


                })

            } else {
                _e.target.value = '';
                this.$searchResults.style.display = 'none';
            }
        })
    }
}