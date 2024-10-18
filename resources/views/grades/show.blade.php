<x-layout>
    <h1>Ученики класса: <span id="grade-name"></span></h1>
    <button id="add-student-button">Добавить ученика</button>
    <div id="students-list"></div>

    <script>
        const gradeId = window.location.pathname.split('/').pop();
        async function fetchStudents() {
            try {
                const response = await axios.get(`/api/grades/${gradeId}`);
                const { grade, students } = response.data;
                document.getElementById('grade-name').textContent = grade.name;
                const studentsList = document.getElementById('students-list');
                studentsList.innerHTML = '';

                if (students.length > 0) {
                    students.forEach(student => {
                        const studentDiv = document.createElement('div');
                        studentDiv.textContent = `Имя: ${student.name}`;
                        const editButton = document.createElement('button');
                        editButton.textContent = 'Изменить';
                        editButton.onclick = () => editStudent(student.id);
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Удалить';
                        deleteButton.onclick = () => deleteStudent(student.id);
                        studentDiv.appendChild(editButton);
                        studentDiv.appendChild(deleteButton);
                        studentsList.appendChild(studentDiv);
                    });
                } else {
                    studentsList.textContent = 'Нет учеников в этом классе.';
                }
                document.getElementById('add-student-button').onclick = addStudent;
            } catch (error) {
                console.error('Ошибка при получении учеников:', error);
            }
        }

        async function addStudent() {
            const studentName = prompt('Введите имя ученика:');
            if (!studentName) return;

            try {
                await axios.post('/api/students', { name: studentName, grade_id: gradeId });
                fetchStudents();
            } catch (error) {
                console.error('Ошибка при добавлении ученика:', error);
            }
        }

        async function editStudent(id) {
            const newName = prompt('Введите новое имя ученика:');
            if (!newName) return;

            try {
                await axios.put(`/api/students/${id}`, { name: newName, grade_id: gradeId });
                fetchStudents();
            } catch (error) {
                console.error('Ошибка при обновлении ученика:', error);
            }
        }

        async function deleteStudent(id) {
            if (confirm('Вы уверены, что хотите удалить этого ученика?')) {
                try {
                    await axios.delete(`/api/students/${id}`);
                    fetchStudents();
                } catch (error) {
                    console.error('Ошибка при удалении ученика:', error);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchStudents();
        });
    </script>
</x-layout>
