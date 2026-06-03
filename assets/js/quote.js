const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";

  function updateQuote() {
      fetch(ajaxUrl + "?action=get_random_quote")
          .then(response => response.json())
          .then(data => {
              if (!data) return;

              document.getElementById("quote-box").href = data.url;
              document.getElementById("quote-text").textContent = data.text;
          })
          .catch(error => console.error(error));
  }

  setInterval(updateQuote, 5000);