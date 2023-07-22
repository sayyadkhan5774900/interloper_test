document.addEventListener('DOMContentLoaded', function () {
    const createTaskForm = document.getElementById('createTaskForm');

    createTaskForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(createTaskForm);

        fetch('/tasks', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => {
                if (response.status === 200) {
                    alert('Task Added')
                    createTaskForm.reset();
                } else {
                    alert('Failed to create task.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    });
});
