import axios from 'axios';

export async function fetchTeachers() {
    try {
        const response = await axios.get('/api/teachers');
        const teachers = response.data;

        const teachersList = document.getElementById('teachers-list');
        teachersList.innerHTML = '';

        teachers.forEach(teacher => {
            const subjectName = teacher.subject ? teacher.subject.name : 'Нет предмета';
            const teacherItem = document.createElement('div');
            teacherItem.textContent = `Имя: ${teacher.name}, Email: ${teacher.email}, Преподает: ${subjectName}`;

            const editButton = document.createElement('button');
            editButton.textContent = 'Изменить';
            editButton.onclick = () => editTeacher(teacher.id, teacher.subject_id);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Удалить';
            deleteButton.onclick = () => deleteTeacher(teacher.id);

            teacherItem.appendChild(editButton);
            teacherItem.appendChild(deleteButton);
            teachersList.appendChild(teacherItem);
        });

        const addTeacherButton = document.createElement('button');
        addTeacherButton.textContent = 'Добавить учителя';
        addTeacherButton.onclick = addTeacher;
        teachersList.appendChild(addTeacherButton);

    } catch (error) {
        console.error('Ошибка при получении учителей:', error);
    }
}

async function addTeacher() {
    const name = prompt('Введите имя учителя:');
    const email = prompt('Введите email учителя:');
    const password = prompt('Введите пароль учителя:');
    const subjectId = await selectSubject();
    const role = prompt('Введите роль учителя (например, "teacher" или "admin"):');

    if (!name || !email || !password || !role) {
        alert('Имя, email, пароль и роль обязательны!');
        return;
    }

    try {
        await axios.post('/api/teachers', { name, email, password, subject_id: subjectId, role });
        fetchTeachers();
    } catch (error) {
        console.error('Ошибка при добавлении учителя:', error.response.data);
    }
}

async function editTeacher(id, currentSubjectId) {
    const name = prompt('Введите новое имя учителя:');
    const email = prompt('Введите новый email учителя:');
    const password = prompt('Введите новый пароль учителя (оставьте пустым, если не хотите менять):');
    const subjectId = await selectSubject(currentSubjectId);
    const role = prompt('Введите новую роль учителя (оставьте пустым, если не хотите менять):');

    if (!name || !email) {
        alert('Имя и email обязательны!');
        return;
    }

    const data = { name, email, subject_id: subjectId };
    if (password) {
        data.password = password;
    }
    if (role) {
        data.role = role;
    }

    try {
        await axios.put(`/api/teachers/${id}`, data);
        fetchTeachers();
    } catch (error) {
        console.error('Ошибка при изменении учителя:', error.response.data);
    }
}

async function deleteTeacher(id) {
    if (confirm('Вы уверены, что хотите удалить этого учителя?')) {
        try {
            await axios.delete(`/api/teachers/${id}`);
            fetchTeachers();
        } catch (error) {
            console.error('Ошибка при удалении учителя:', error.response.data);
        }
    }
}

async function selectSubject(currentSubjectId) {
    const subjects = {
        1: 'История',
        2: 'Математика',
        3: 'Румынский язык',
        4: 'Русский язык'
    };

    let subjectIds = Object.keys(subjects).map(id => `${id}: ${subjects[id]}`).join('\n');
    const subjectId = prompt(`Выберите предмет:\n${subjectIds}`);

    return subjectId && subjects[subjectId] ? subjectId : currentSubjectId; 
}
