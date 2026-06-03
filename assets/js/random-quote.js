function updateQuote() {
    fetch(quoteAjax.ajaxUrl + "?action=get_random_quote")
        .then(response => response.json())
        .then(data => {
            if (!data) return;

            const quoteBox = document.getElementById("quote-box");
            const quoteText = document.getElementById("quote-text");

            if (!quoteBox || !quoteText) return;

            quoteBox.href = data.url;
            quoteText.textContent = data.text;
        })
        .catch(error => console.error(error));
}

setInterval(updateQuote, 5000);