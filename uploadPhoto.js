document.addEventListener("submit", async function(e){
    if(e.target.closest("#uploadPhoto")){
        e.preventDefault()
        let form = e.target.closest("#uploadPhoto")
        let uploadedPhoto = e.target.querySelector("#photo")
        let formData = new FormData(form)
        formData.append("photo",uploadedPhoto)

        try {
            const response = await fetch("/bbb/uploadPhoto.php", {
                method: "POST",
                body: formData,
            });
            const data = await response.text();
            if (data == "success") {
              window.location.reload()
            }
        } catch (error) {
            console.log(error.message, "error");
        }
    }
})