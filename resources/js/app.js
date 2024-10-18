import './bootstrap';
import { fetchGrades } from './Components/grades.js';
import { fetchTeachers } from './Components/teachers.js';

document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;

    switch (path) {
        case '/grades':
        case '/dashboard':
            fetchGrades();
            break;
        case '/teachers':
            fetchTeachers();
            break;
    }
});
