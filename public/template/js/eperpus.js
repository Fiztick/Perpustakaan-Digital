function updateCustomFileLabel(inputId) {
    const input = $(`#${inputId}`);
    const label = input.next('.custom-file-label');
    const fileName = input.val().split('\\').pop(); // Extract the filename from the file input value
    label.text(fileName);
}