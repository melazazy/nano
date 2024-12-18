document.addEventListener('livewire:load', function () {
    // Your JavaScript code here
document.getElementById('attachfile').addEventListener('change', function(event) {
    const files = event.target.files;
    const maxSize = 5 * 1024 * 1024; // 5MB

    for (let i = 0; i < files.length; i++) {
        if (files[i].size > maxSize) {
            alert('File size exceeds 5MB limit');
            event.target.value = ''; // Clear the input
            break;
        }
    }
});
});