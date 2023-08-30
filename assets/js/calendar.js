document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar_admin');
  const containerEl = document.getElementById('external-events');
  const checkbox = document.getElementById('drop-remove');


  fetch('event_index', {})
    .then(response => response.json())
    .then(eventList => {

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        locale: 'fr',

        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        buttonText: {
          today: "Aujourd'hui",
          month: 'Mois',
          week: 'Semaine',
          day: 'Jour',
          list: 'Liste'
        },
        events: eventList,
        selectable: true,
        editable: true,
        nowIndicator: true,

        select: async function(start, end, allDay) {

          const defaultStart = moment(start).set({ 'hour': 8, 'minute': 0, 'second': 0 });
          const defaultEnd = moment(start).set({ 'hour': 18, 'minute': 0, 'second': 0 });

          const { value: formValues } = await Swal.fire({
            title: 'Ajouter un événement',
            confirmButtonText: 'Soumettre',
            showCloseButton: true,
            showCancelButton: true,
            html: `
              <input id="swalTitle" class="swal2-input" placeholder="Titre">
              <textarea id="swalDescription" class="swal2-input" placeholder="Description"></textarea>
              <input id="swalStart" class="swal2-input" type="datetime-local" value="${defaultStart.format('YYYY-MM-DDTHH:mm:ss')}" placeholder="Date de début">
              <input id="swalEnd" class="swal2-input" type="datetime-local" value="${defaultEnd.format('YYYY-MM-DDTHH:mm:ss')}" placeholder="Date de fin">
            `,
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById('swalTitle').value,
                document.getElementById('swalDescription').value,
                document.getElementById('swalStart').value,
                document.getElementById('swalEnd').value
              ];
            }
          });

          if (formValues) {
            let formData = new FormData();

            formData.append('start', document.getElementById('swalStart').value);
            formData.append('end', document.getElementById('swalEnd').value);
            formData.append('title', formValues[0]);
            formData.append('description', formValues[1]);

            const options = {
              method: 'POST',
              body: formData
            };

            fetch('create_event', options)
              .then(response => response.json())
              .then(data => {
                if (data.status == 1) {
                  Swal.fire('Événement ajouté avec succès!', '', 'success');
                  window.location.reload(); // Rafraîchir les événements après ajout
                }
                else {
                  Swal.fire(data.error, '', 'error');
                }
              })
              .catch(console.error);
          }
        },
        dateClick: function(info) {
          const selectedDate = info.date;
          const defaultStart = moment(selectedDate).set({ 'hour': 8, 'minute': 0, 'second': 0 });
          const defaultEnd = moment(selectedDate).set({ 'hour': 18, 'minute': 0, 'second': 0 });

          const swalStartInput = document.getElementById('swalStart');
          const swalEndInput = document.getElementById('swalEnd');
          swalStartInput.value = defaultStart.format('YYYY-MM-DDTHH:mm:ss');
          swalEndInput.value = defaultEnd.format('YYYY-MM-DDTHH:mm:ss');

          // ... Le reste de votre code ...

        },
        eventClick: function(info) {
          // Code pour gérer le clic sur un événement existant
          info.jsEvent.preventDefault();

          const eventId = info.event.id;
          if (confirm("Êtes-vous sûr de vouloir supprimer cet événement ?")) {
            deleteEvent(eventId);
          }
          showEditForm(eventId);
        },


        // ... Le reste de votre code ...

      });

      async function deleteEvent(eventId) {
        const response = await fetch('/projet-final-v2/delete_event&id=' + eventId, {
          method: 'DELETE'
        });

        if (response.ok) {
          const updatedEvents = await response.json();
          calendar.getEvents().forEach(event => event.remove()); // Supprimer tous les événements actuellement affichés
          calendar.addEventSource(updatedEvents); // Ajouter les événements mis à jour
        }
        else {
          alert('Erreur lors de la suppression de l\'événement');
        }
      }

      calendar.render();
    });
});
