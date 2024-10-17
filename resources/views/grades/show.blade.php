<x-layout>
    <div class="container">
        <h1>Ученики класса: <span id="grade-name"></span></h1>
        <div id="students-list"></div>
    </div>
    <script>
        // Получаем ID класса из URL
        const gradeId = window.location.pathname.split('/').pop();
        console.log(gradeId);
        // Функция для получения учеников
        async function fetchStudents() {
            try {
                const response = await axios.get(`/api/grades/${gradeId}`);
                const { grade, students } = response.data;

                // Устанавливаем имя класса
                document.getElementById('grade-name').textContent = grade.name;

                // Получаем элемент для отображения учеников
                const studentsList = document.getElementById('students-list');

                // Очищаем контейнер перед добавлением новых элементов
                studentsList.innerHTML = '';

                // Заполняем контейнер учениками
                if (students.length > 0) {
                    students.forEach(student => {
                        const studentDiv = document.createElement('div');
                        studentDiv.textContent = `Имя: ${student.name}, Возраст: ${student.age}`; // Отображаем информацию о студенте
                        studentsList.appendChild(studentDiv);
                    });
                } else {
                    studentsList.textContent = 'Нет учеников в этом классе.'; // Сообщение, если учеников нет
                }
            } catch (error) {
                console.error('Ошибка при получении учеников:', error);
            }
        }

        // Вызов функции для получения учеников при загрузке страницы
        document.addEventListener('DOMContentLoaded', fetchStudents);
    </script>
</x-layout>
