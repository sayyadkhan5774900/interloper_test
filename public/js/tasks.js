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

document.addEventListener('DOMContentLoaded', function () {
    const completeButtons = document.querySelectorAll('.complete-btn');

    completeButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const taskId = this.getAttribute('task-id');
            const taskRow = this.closest('tr');

            fetch(`/tasks/${taskId}/mark-as-completed`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(data => {
                    if (data.status === 200) {
                        taskRow.classList.add('table-success');
                        taskRow.querySelector('td:nth-child(4)').innerHTML = '<span class="badge bg-success">Completed</span>';
                        this.remove();
                    } else {
                        alert('Failed to mark task as completed.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    });
});
