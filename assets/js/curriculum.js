document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    const curriculumForm = document.getElementById('curriculum-form');
    const editCurriculumForm = document.getElementById('edit-curriculum-form');
    const curriculumTableBody = document.getElementById('curriculum-table-body');
    const addSubjectBtn = document.getElementById('add-subject-btn');
    const subjectsContainer = document.getElementById('subjects-container');
    const editSubjectsContainer = document.getElementById('edit-subjects-container');

    if (!curriculumForm || !editCurriculumForm || !curriculumTableBody || !addSubjectBtn || !subjectsContainer || !editSubjectsContainer) {
        console.error('Required elements not found');
        return;
    }

    // Add Subject Field
    addSubjectBtn.addEventListener('click', () => {
        const div = document.createElement('div');
        div.classList.add('subject-row', 'mb-3');
        div.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="subject_name[]" placeholder="Subject Name" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="subject_code[]" placeholder="Subject Code" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="units[]" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="subject_type[]" required>
                        <option value="">--select--</option>
                        <option value="Core">Core Subject</option>
                        <option value="Specialized">Specialized</option>
                        <option value="Elective">Elective</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-subject-btn">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </div>
        `;
        subjectsContainer.appendChild(div);
    });

    // Remove Subject Field
    subjectsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.remove-subject-btn')) {
            e.target.closest('.subject-row').remove();
        }
    });

    // Remove Edit Subject Field
    editSubjectsContainer.addEventListener('click', (e) => {
        if (e.target.closest('.remove-subject-btn')) {
            e.target.closest('.edit-subject-row').remove();
        }
    });

    // Add Curriculum
    curriculumForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('action', 'add');

        fetch('http://localhost/school-management-system/admin_panel/api/curriculum.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Curriculum added successfully!');
                this.reset();
                subjectsContainer.innerHTML = '';
                fetchCurriculums();
            } else {
                alert(data.message || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the curriculum');
        });
    });

    // Edit Curriculum
    editCurriculumForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('action', 'edit');

        fetch('http://localhost/school-management-system/admin_panel/api/curriculum.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Curriculum updated successfully!');
                fetchCurriculums();
                const modal = bootstrap.Modal.getInstance(document.getElementById('editCurriculumModal'));
                if (modal) {
                    modal.hide();
                }
            } else {
                alert(data.message || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while editing the curriculum');
        });
    });

    // Fetch Curriculums
    function fetchCurriculums() {
        fetch('http://localhost/school-management-system/admin_panel/api/curriculum.php?action=fetch')
            .then(response => response.json())
            .then(curriculums => {
                curriculumTableBody.innerHTML = '';
                
                curriculums.forEach(curriculum => {
                    const row = `
                        <tr>
                            <td>${curriculum.curriculum_name}</td>
                            <td>${curriculum.description}</td>
                            <td>${curriculum.school_year}</td>
                            <td>${curriculum.grade_levels}</td>
                            <td>${curriculum.status}</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" data-id="${curriculum.id}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${curriculum.id}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    curriculumTableBody.insertAdjacentHTML('beforeend', row);
                });

                // Edit Button
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const id = button.getAttribute('data-id');
                        fetch(`http://localhost/school-management-system/admin_panel/api/curriculum.php?action=get&id=${id}`)
                            .then(response => response.json())
                            .then(curriculum => {
                                if (curriculum.id) {
                                    document.getElementById('edit_curriculum_id').value = curriculum.id;
                                    document.getElementById('edit_curriculum_name').value = curriculum.curriculum_name;
                                    document.getElementById('edit_description').value = curriculum.description;
                                    document.getElementById('edit_school_year').value = curriculum.school_year;
                                    document.getElementById('edit_grade_levels').value = curriculum.grade_levels;
                                    document.getElementById('edit_status').value = curriculum.status;

                                    // Clear and Add subjects
                                    editSubjectsContainer.innerHTML = '';
                                    if (curriculum.subjects) {
                                        curriculum.subjects.forEach(subject => {
                                            const div = document.createElement('div');
                                            div.classList.add('edit-subject-row', 'mb-3');
                                            div.innerHTML = `
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="edit_subject_name[]" value="${subject.subject_name}" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="edit_subject_code[]" value="${subject.subject_code}" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" class="form-control" name="edit_units[]" value="${subject.units}" min="1" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-select" name="edit_subject_type[]" required>
                                                            <option value="">--select--</option>
                                                            <option value="Core" ${subject.subject_type === 'Core' ? 'selected' : ''}>Core Subject</option>
                                                            <option value="Specialized" ${subject.subject_type === 'Specialized' ? 'selected' : ''}>Specialized</option>
                                                            <option value="Elective" ${subject.subject_type === 'Elective' ? 'selected' : ''}>Elective</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-danger remove-subject-btn">
                                                            <i class='bx bx-trash'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            `;
                                            editSubjectsContainer.appendChild(div);
                                        });
                                    }

                                    // Show modal
                                    const modal = new bootstrap.Modal(document.getElementById('editCurriculumModal'));
                                    modal.show();
                                } else {
                                    alert('Curriculum not found');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });

                // Delete Button
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const id = button.getAttribute('data-id');
                        if (confirm('Are you sure you want to delete this curriculum?')) {
                            const formData = new FormData();
                            formData.append('action', 'delete');
                            formData.append('id', id);

                            fetch('http://localhost/school-management-system/admin_panel/api/curriculum.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Curriculum deleted successfully!');
                                    fetchCurriculums();
                                } else {
                                    alert(data.message || 'Failed to delete curriculum.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                        }
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Initial load
    fetchCurriculums();
});