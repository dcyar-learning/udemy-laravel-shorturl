window.shorter = {
    shortUrl: () => {
        const longUrl = document.getElementById('long_url');

        if (shorter.validateUrl(longUrl.value)) {
            axios.post('/url', {
                long_url: longUrl.value
            })
                .then(response => {
                    longUrl.value = ''

                    document.getElementById('short_url_container').style.display = 'block';
                    document.getElementById('short_url').value = response.data.short_url;
                })
                .catch(err => console.log(err))
        }
    },
    copyUrl: () => {
        const shortUrl = document.getElementById('short_url');

        shortUrl.select();
        shortUrl.setSelectionRange(0, 99999);

        document.execCommand('copy');
    },
    validateUrl: (url) => {
        let status = true;

        if (url.trim() == '') {
            status = false;
            alert('Please enter a valid URL');
        }

        if (!validUrl.isWebUri(url)) {
            status = false;
            alert('Please enter a valid URL');
        }

        return status;
    }
}
