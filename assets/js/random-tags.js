function updateRandomTags() {
    fetch(tagAjax.ajaxUrl + '?action=get_random_tags')
        .then(response => response.json())
        .then(data => {
            if (!data) return;

            document
                .querySelectorAll('.js-random-tag-list')
                .forEach((tagList) => {
                    tagList.innerHTML = '';

                    data.forEach((tag) => {
                        const li = document.createElement('li');
                        const a = document.createElement('a');

                        a.href = tag.url;
                        a.textContent = tag.name;

                        li.appendChild(a);
                        tagList.appendChild(li);
                    });
                });
        })
        .catch(error => console.error(error));
}

setInterval(updateRandomTags, 10000);