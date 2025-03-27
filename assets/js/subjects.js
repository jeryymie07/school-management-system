document.addEventListener('DOMContentLoaded', () => {
    loadSubjects();

    // Add Subject Form Submission
    document.getElementById('create-subject-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const subjectCode = formData.get('subject_code');
        const subjectName = formData.get('subject_name');
        const description = formData.get('description');
        const gradeLevel = formData.get('class');
        const status = formData.get('status');

        try {
            const response = await fetch('api/subjects.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'add',
                    subject_code: subjectCode,
                    subject_name: subjectName,
                    description: description,
                    grade_level_id: gradeLevel,
                    status: status
                })
            });

            const data = await response.json();
            
            if (data.success) {
                alert('Subject added successfully!');
                e.target.reset();
                $('#add-subject').modal('hide');
                loadSubjects();
            } else {
                alert(data.message || 'Failed to add subject');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while adding the subject');
        }
    });

    // Edit Subject Form Submission
    document.getElementById('editSubjectForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const subjectId = document.getElementById('edit-subject-id').value;
        const subjectCode = formData.get('subject_code');
        const subjectName = formData.get('subject');
        const description = formData.get('description');
        const gradeLevel = formData.get('class');
        const status = formData.get('status');

        try {
            const response = await fetch('api/subjects.php', {
                method: 'POST',
                body: new URLSearchParams({
                    action: 'edit',
                    id: subjectId,
                    subject_code: subjectCode,
                    subject_name: subjectName,
                    description: description,
                    grade_level_id: gradeLevel,
                    status: status
                })
            });

            const data = await response.json();
            
            if (data.success) {
                alert('Subject updated successfully!');
                e.target.reset();
                $('#edit-subject').modal('hide');
                loadSubjects();
            } else {
                alert(data.message || 'Failed to update subject');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while updating the subject');
        }
    });

    // Load Subjects
    async function loadSubjects() {
        try {
            const response = await fetch('api/subjects.php?action=get_all');
            const data = await response.json();
            
            const tbody = document.getElementById('subject-table-body');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center">No subjects found</td>
                    </tr>
                `;
                return;
            }

            data.forEach((subject, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${subject.subject_code}</td>
                        <td>${subject.subject_name}</td>
                        <td>${subject.description || ''}</td>
                        <td>${subject.grade_level}</td>
                        <td>${subject.status}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-subject-btn" data-id="${subject.id}">
                                <i class='bx bx-edit'></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-subject-btn" data-id="${subject.id}">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            // Add event listeners to edit buttons
            document.querySelectorAll('.edit-subject-btn').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const subjectId = e.target.dataset.id;
                    try {
                        const response = await fetch(`api/subjects.php?action=get&id=${subjectId}`);
                        const subject = await response.json();

                        document.getElementById('edit-subject-id').value = subject.id;
                        document.getElementById('edit-subject-code').value = subject.subject_code;
                        document.getElementById('subject-edited-name').value = subject.subject_name;
                        document.getElementById('edit-description').value = subject.description || '';
                        document.getElementById('edit-class').value = subject.grade_level_id;
                        document.getElementById('edit-status').value = subject.status;

                        new bootstrap.Modal(document.getElementById('edit-subject')).show();
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to load subject details');
                    }
                });
            });

            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-subject-btn').forEach(button => {
                button.addEventListener('click', async (e) => {
                    if (confirm('Are you sure you want to delete this subject?')) {
                        const subjectId = e.target.dataset.id;
                        try {
                            const response = await fetch('api/subjects.php', {
                                method: 'POST',
                                body: new URLSearchParams({
                                    action: 'delete',
                                    id: subjectId
                                })
                            });

                            const data = await response.json();
                            
                            if (data.success) {
                                alert('Subject deleted successfully!');
                                loadSubjects();
                            } else {
                                alert(data.message || 'Failed to delete subject');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('An error occurred while deleting the subject');
                        }
                    }
                });
            });
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to load subjects');
        }
    }
});
