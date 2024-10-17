import './bootstrap';
import axios from 'axios';

// Функция для получения классов, к которым прикреплён учитель
async function fetchGrades() {
    try {
        const teacherId = authUserId; // Используйте переданную переменную
        let response;

        // Условие для проверки, является ли учитель директором или его ID равен 1
        if (teacherId === 1) {
            // Директор, делаем запрос на /api/grades
            response = await axios.get('/api/grades');
        } else {
            // Обычный учитель, делаем запрос на /api/teacher/grades/{teacherId}
            response = await axios.get(`/api/teacher/grades/${teacherId}`);
        }

        const grades = response.data;

        const gradesList = document.getElementById('grades-list');
        gradesList.innerHTML = '';

        grades.forEach(grade => {
            const link = document.createElement('a');
            link.href = `/grades/${grade.id}`;
            link.textContent = `Класс: ${grade.name}`;
            link.classList.add('grade-link');

            gradesList.appendChild(link);
            gradesList.appendChild(document.createElement('br'));
        });
    } catch (error) {
        console.error('Ошибка при получении классов:', error);
    }
}

// Вызов функции для получения классов при загрузке страницы
document.addEventListener('DOMContentLoaded', fetchGrades);
