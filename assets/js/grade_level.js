document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentPage = 1;
    const itemsPerPage = 10;
    let totalItems = 0;

    // Form validation
    const gradeLevelForm = document.getElementById('grade-level-form');
    const editGradeLevelForm = document.getElementById('edit-grade-level-form');

    // Add event listeners
    gradeLevelForm.addEventListener('submit', handleAddGradeLevel);
    editGradeLevelForm.addEventListener('submit', handleEditGradeLevel);
    document.getElementById('searchGradeByNameBtn').addEventListener('click', handleSearch);
    document.getElementById('prev-page-btn').addEventListener('click', () => changePage(currentPage - 1));
    document.getElementById('next-page-btn').addEventListener('click', () => changePage(currentPage + 1));

    // Initialize the page
    showGradeLevels();

    // Form submission handlers
    async function handleAddGradeLevel(e) {
        e.preventDefault();
        if (!gradeLevelForm.checkValidity()) {
            e.stopPropagation();
            gradeLevelForm.classList.add('was-validated');
            return;
        }

        const formData = {
            grade_name: document.getElementById('grade_name').value,
            description: document.getElementById('description').value,
            section: document.getElementById('section').value,
            educational_stage: document.getElementById('educational_stage').value
        };

        try {
            const response = await fetch('api/grade-levels.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'add', data: formData })
            });

            const result = await response.json();
            if (result.success) {
                showGradeLevels();
                gradeLevelForm.reset();
                $('#addGradeLevelModal').modal('hide');
                showSuccessAlert('Grade level added successfully');
            } else {
                showErrorAlert(result.message || 'Failed to add grade level');
            }
        } catch (error) {
            showErrorAlert('An error occurred while adding grade level');
        }
    }

    async function handleEditGradeLevel(e) {
        e.preventDefault();
        if (!editGradeLevelForm.checkValidity()) {
            e.stopPropagation();
            editGradeLevelForm.classList.add('was-validated');
            return;
        }

        const formData = {
            id: document.getElementById('edit_grade_id').value,
            grade_name: document.getElementById('edit_grade_name').value,
            description: document.getElementById('edit_description').value,
            section: document.getElementById('edit_section').value,
            educational_stage: document.getElementById('edit_educational_stage').value
        };

        try {
            const response = await fetch('api/grade-levels.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'edit', data: formData })
            });

            const result = await response.json();
            if (result.success) {
                showGradeLevels();
                editGradeLevelForm.reset();
                $('#editGradeLevelModal').modal('hide');
                showSuccessAlert('Grade level updated successfully');
            } else {
                showErrorAlert(result.message || 'Failed to update grade level');
            }
        } catch (error) {
            showErrorAlert('An error occurred while updating grade level');
        }
    }

    // CRUD operations
    async function showGradeLevels(searchTerm = '') {
        try {
            const response = await fetch(`api/grade-levels.php?action=list&page=${currentPage}&search=${searchTerm}`);
            const result = await response.json();

            if (result.success) {
                totalItems = result.total;
                updatePagination();
                populateGradeLevelTable(result.data);
            }
        } catch (error) {
            showErrorAlert('Error loading grade levels');
        }
    }

    function populateGradeLevelTable(gradeLevels) {
        const tbody = document.getElementById('grade-table-body');
        tbody.innerHTML = '';

        gradeLevels.forEach((grade, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${(currentPage - 1) * itemsPerPage + index + 1}</td>
                <td>${grade.grade_name}</td>
                <td>${grade.educational_stage}</td>
                <td>${grade.section || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="editGradeLevel(${grade.id})">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteGradeLevel(${grade.id})">
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });

        if (gradeLevels.length === 0) {
            showNoDataMessage();
        }
    }

    function showNoDataMessage() {
        const noDataDiv = document.getElementById('dataNotAvailable');
        noDataDiv.style.display = 'block';
    }

    function hideNoDataMessage() {
        const noDataDiv = document.getElementById('dataNotAvailable');
        noDataDiv.style.display = 'none';
    }

    function updatePagination() {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        document.getElementById('prev-page-btn').disabled = currentPage === 1;
        document.getElementById('next-page-btn').disabled = currentPage === totalPages;
        document.getElementById('page-number').textContent = currentPage;
    }

    async function deleteGradeLevel(id) {
        if (!confirm('Are you sure you want to delete this grade level?')) {
            return;
        }

        try {
            const response = await fetch('api/grade-levels.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'delete', id: id })
            });

            const result = await response.json();
            if (result.success) {
                showGradeLevels();
                showSuccessAlert('Grade level deleted successfully');
            } else {
                showErrorAlert(result.message || 'Failed to delete grade level');
            }
        } catch (error) {
            showErrorAlert('An error occurred while deleting grade level');
        }
    }

    function editGradeLevel(id) {
        // Implement the edit functionality
        // This should fetch the grade level data and populate the edit form
    }

    // Search functionality
    function handleSearch() {
        const searchTerm = document.getElementById('search-grade-name').value.trim();
        showGradeLevels(searchTerm);
    }

    // Helper functions
    function showSuccessAlert(message) {
        alert(message);
    }

    function showErrorAlert(message) {
        alert(message);
    }

    function changePage(page) {
        if (page < 1 || page > Math.ceil(totalItems / itemsPerPage)) return;
        currentPage = page;
        showGradeLevels();
    }
});