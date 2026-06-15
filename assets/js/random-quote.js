function updateQuote() {
    fetch(quoteAjax.ajaxUrl + "?action=get_random_quote")
        .then(response => response.json())
        .then(data => {

            if (!data) return;

            document
                .querySelectorAll(".js-quote-box")
                .forEach((quoteBox) => {

                    quoteBox.href = data.url;

                    const quoteText = quoteBox.querySelector(
                        ".js-quote-text"
                    );

                    if (quoteText) {
                        quoteText.textContent = data.text;
                    }

                });

        })
        .catch(error => console.error(error));
}

setInterval(updateQuote, ROTATION_INTERVAL);