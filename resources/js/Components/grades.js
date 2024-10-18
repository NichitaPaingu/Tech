import axios from 'axios';
export async function fetchGrades() {
    try {
        const teacherId = authUserId;
        let response;
        if (teacherId === 1) {
            response = await axios.get('/api/grades');
        } else {
            response = await axios.get(`/api/teacher/grades/${teacherId}`);
        }

        const grades = response.data;

        const gradesList = document.getElementById('grades-list');
        gradesList.innerHTML = '';

        grades.forEach(grade => {
            const gradeItem = document.createElement('div');
            gradeItem.textContent = `Класс: ${grade.name}`;

            const editButton = document.createElement('button');
            editButton.textContent = 'Изменить';
            editButton.onclick = () => editGrade(grade.id);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Удалить';
            deleteButton.onclick = () => deleteGrade(grade.id);

            const studentsButton = document.createElement('a');
            studentsButton.href = `/grades/${grade.id}`;
            studentsButton.textContent = 'Посмотреть учеников';
            studentsButton.style.marginLeft = '10px';
            studentsButton.className = 'view-students-button';

            gradeItem.appendChild(editButton);
            gradeItem.appendChild(deleteButton);
            gradeItem.appendChild(studentsButton);
            gradesList.appendChild(gradeItem);
        });

        if (authUserId === 1) {
            const createButton = document.createElement('button');
            createButton.textContent = 'Создать класс';
            createButton.onclick = createGrade;
            document.getElementById('grades').appendChild(createButton);
        }
    } catch (error) {
        console.error('Ошибка при получении классов:', error);
    }
}

async function createGrade() {
    const gradeName = prompt('Введите название класса:');
    if (!gradeName) return;

    try {
        const response = await axios.post('/api/grades', { name: gradeName });
        console.log('Класс создан:', response.data);
        fetchGrades();
    } catch (error) {
        console.error('Ошибка при создании класса:', error);
    }
}

async function editGrade(id) {
    const gradeName = prompt('Введите новое название класса:');
    if (!gradeName) return;

    try {
        const response = await axios.put(`/api/grades/${id}`, { name: gradeName });
        console.log('Класс обновлён:', response.data);
        fetchGrades();
    } catch (error) {
        console.error('Ошибка при обновлении класса:', error);
    }
}

async function deleteGrade(id) {
    if (confirm('Вы уверены, что хотите удалить этот класс?')) {
        try {
            await axios.delete(`/api/grades/${id}`);
            console.log(`Класс с ID ${id} удалён`);
            fetchGrades();
        } catch (error) {
            console.error('Ошибка при удалении класса:', error);
        }
    }
}
