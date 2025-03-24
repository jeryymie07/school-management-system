// curriculum.js

// Add Subject Button Click
document.getElementById('add-subject-btn').addEventListener('click', function() {
    const container = document.getElementById('subjects-container');
    const subjectCount = container.children.length;
    
    const subjectHtml = `
        <div class="subject-row mb-3" id="subject-row-${subjectCount}">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="subject_name[]" placeholder="Subject Name" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="subject_code[]" placeholder="Subject Code" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="units[]" placeholder="Units" required>
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
                    <button type="button" class="btn btn-danger remove-subject-btn" onclick="removeSubject(${subjectCount})">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', subjectHtml);
});

function removeSubject(index) {
    const element = document.getElementById(`subject-row-${index}`);
    if (element) {
        element.remove();
    }
}

// Form Submission
document.getElementById('curriculum-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    // Add all subjects to formData
    const subjectRows = document.querySelectorAll('.subject-row');
    subjectRows.forEach(row => {
        const subjectName = row.querySelector('input[name="subject_name[]"]').value;
        const subjectCode = row.querySelector('input[name="subject_code[]"]').value;
        const units = row.querySelector('input[name="units[]"]').value;
        const subjectType = row.querySelector('select[name="subject_type[]"]').value;
        
        formData.append('subjects[]', JSON.stringify({
            name: subjectName,
            code: subjectCode,
            units: units,
            type: subjectType
        }));
    });
    
    // Send AJAX request
    fetch('api/curriculum.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and refresh table
            $('#addCurriculumModal').modal('hide');
            loadCurriculumTable();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Load Curriculum Table
function loadCurriculumTable() {
    fetch('api/curriculum.php?action=get_all')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('curriculum-table-body');
        tbody.innerHTML = '';
        
        data.forEach((curriculum, index) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${curriculum.name}</td>
                    <td>${curriculum.school_year}</td>
                    <td>${curriculum.grade_levels}</td>
                    <td>${curriculum.status}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editCurriculum(${curriculum.id})">
                            <i class='bx bx-edit'></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCurriculum(${curriculum.id})">
                            <i class='bx bx-trash'></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
        
        // Show/hide no data message
        const noData = document.getElementById('curriculumDataNotAvailable');
        noData.style.display = data.length > 0 ? 'none' : 'block';
    })
    .catch(error => console.error('Error:', error));
}

// Edit Curriculum
function editCurriculum(id) {
    // Load curriculum data
    fetch(`api/curriculum.php?action=get&id=${id}`)
    .then(response => response.json())
    .then(data => {
        // Populate edit form
        document.getElementById('edit_curriculum_id').value = data.id;
        document.getElementById('edit_curriculum_name').value = data.name;
        document.getElementById('edit_description').value = data.description;
        document.getElementById('edit_school_year').value = data.school_year;
        document.getElementById('edit_grade_levels').value = data.grade_levels;
        document.getElementById('edit_status').value = data.status;
        
        // Load subjects
        const container = document.getElementById('edit-subjects-container');
        container.innerHTML = '';
        data.subjects.forEach((subject, index) => {
            const subjectHtml = `
                <div class="subject-row mb-3" id="edit-subject-row-${index}">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="edit_subject_name[]" value="${subject.name}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="edit_subject_code[]" value="${subject.code}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="edit_units[]" value="${subject.units}" required>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="edit_subject_type[]" required>
                                <option value="">--select--</option>
                                <option value="Core" ${subject.type === 'Core' ? 'selected' : ''}>Core Subject</option>
                                <option value="Specialized" ${subject.type === 'Specialized' ? 'selected' : ''}>Specialized</option>
                                <option value="Elective" ${subject.type === 'Elective' ? 'selected' : ''}>Elective</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', subjectHtml);
        });
        
        // Show modal
        $('#editCurriculumModal').modal('show');
    })
    .catch(error => console.error('Error:', error));
}

// Delete Curriculum
function deleteCurriculum(id) {
    if (confirm('Are you sure you want to delete this curriculum?')) {
        fetch(`api/curriculum.php?action=delete&id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCurriculumTable();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Search Functionality
document.getElementById('search-curriculum-name').addEventListener('input', function() {
    const searchBtn = document.getElementById('searchCurriculumByNameBtn');
    searchBtn.disabled = this.value.trim() === '';
});

document.getElementById('searchCurriculumByNameBtn').addEventListener('click', function() {
    const searchValue = document.getElementById('search-curriculum-name').value;
    fetch(`api/curriculum.php?action=search&query=${searchValue}`)
    .then(response => response.json())
    .then(data => {
        loadCurriculumTable();
    })
    .catch(error => console.error('Error:', error));
});

// Pagination
document.getElementById('prev-curriculum-page-btn').addEventListener('click', function() {
    
});
document.getElementById('next-curriculum-page-btn').addEventListener('click', function() {
    
});