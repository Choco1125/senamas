const peticion = {
    url: 'http://localhost/senamas/index.php?',
    post: async function (controller, action, formData) {
        try {
            let query = `controller=${controller}&action=${action}`;

            let res = await fetch(`${this.url}${query}`, {
                method: 'POST',
                body: formData
            });

            return await res.json();
        } catch (error) {
            console.error(error)
        }
    },
    get: async function (controller, action) {
        try {
            let query = `controller=${controller}&action=${action}`;
            let res = await fetch(`${this.url}${query}`);
            return await res.json();
        } catch (error) {
            console.error(error)
        }
    }
}