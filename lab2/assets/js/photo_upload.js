let form = document.getElementById('form-upload-photo');
let button = document.getElementById('btn-upload-photo');
let file_selector = document.getElementById('file-photo');

button.onclick = () => {
    file_selector.click();
}

file_selector.onchange = () => {
    form.submit();
}
