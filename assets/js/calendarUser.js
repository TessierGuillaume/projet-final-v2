let calendar; // Déclarez une variable pour stocker l'instance de votre calendrier

function adjustCalendarView() {
  if (window.innerWidth < 480) {
    calendar.changeView('timeGridWeek');
    calendar.setOption('hiddenDays', [0, 6]); // Masquer le dimanche (0) et le samedi (6)
  }
  else {
    calendar.changeView('dayGridMonth');
    calendar.setOption('hiddenDays', []); // Afficher tous les jours dans la vue mois
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar_user');

  async function fetchData() {
    const response = await fetch('event_index_user', {});
    return await response.json();
  }

  fetchData().then(eventList => {
    const availableEvents = eventList.filter(event => !event.User_ID);

    function getTimeSlotsForDate(date, eventList) {
      const selectedDate = moment(date);
      const options = [];

      for (let i = 8; i < 18; i++) {
        for (let j = 0; j < 60; j += 45) {
          const startTimeHour = i;
          const startTimeMinute = j;
          const endTimeHour = j + 45 >= 60 ? i + 1 : i;
          const endTimeMinute = (j + 45) % 60;
          if (endTimeHour === 18 && endTimeMinute > 0) {
            continue;
          }
          const startTime = `${startTimeHour.toString().padStart(2, '0')}:${startTimeMinute.toString().padStart(2, '0')}`;
          const endTime = `${endTimeHour.toString().padStart(2, '0')}:${endTimeMinute.toString().padStart(2, '0')}`;
          let slotStart = `${selectedDate.format('YYYY-MM-DD')} ${startTime}`;
          let slotEnd = `${selectedDate.format('YYYY-MM-DD')} ${endTime}`;

          let isTaken = false;
          for (let x = 0; x < eventList.length; x++) {
            const eventStart = moment(eventList[x].start).format('YYYY-MM-DD HH:mm');
            const eventEnd = moment(eventList[x].end).format('YYYY-MM-DD HH:mm');

            if (eventStart === slotStart) {
              isTaken = true;
              break;
            }
          }

          if (!isTaken) {
            options.push({
              start: moment(slotStart),
              end: moment(slotEnd)
            });
          }
        }
      }

      return options;
    }

    async function createEvent(formData, clickedDate) {
      const options = {
        method: 'POST',
        body: formData
      };

      const response = await fetch('create_event_user', options);
      await response.json();

      Swal.fire({
        title: 'Événement ajouté avec succès!',
        text: `Votre rendez-vous a été enregistré pour le ${moment(clickedDate).format('DD/MM/YYYY à HH:mm')}.`,
        icon: 'success',
        confirmButtonText: 'Fermer'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.reload();
        }
      });
    }

    function checkDayAvailability(dateStr) {
      const date = moment(dateStr);
      const dayOfWeek = date.day(); // 0 = dimanche, 6 = samedi
      if (dayOfWeek === 0 || dayOfWeek === 6) {
        return '<div class="day-full"></div>';
      }
      const timeSlots = getTimeSlotsForDate(date, eventList);
      return timeSlots.length === 0 ? '<div class="day-full"></div>' : '<div class="day-available"></div>';
    }

    calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth', // Définissez une vue initiale par défaut

      contentHeight: 'auto',
      locale: 'fr',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      buttonText: {
        today: "Aujourd'hui",
        month: 'Mois',
        week: 'Semaine',
        day: 'Jour'
      },
      events: availableEvents,
      selectable: true,
      selectMirror: true,
      editable: true,
      nowIndicator: true,
      droppable: true,
      dayCellClassNames: function(dateInfo) {
        const date = moment(dateInfo.date);
        const dayOfWeek = date.day(); // 0 = dimanche, 6 = samedi
        if (dayOfWeek === 0 || dayOfWeek === 6) {
          return ['weekend'];
        }
        const timeSlots = getTimeSlotsForDate(date, eventList);
        return timeSlots.length === 0 ? ['day-full'] : ['day-available'];
      },

      dateClick: function(info) {
        const selectedDate = moment(info.date);
        const dayOfWeek = selectedDate.day(); // 0 = dimanche, 6 = samedi

        // Vérifie si le jour est un samedi ou un dimanche
        if (dayOfWeek === 0 || dayOfWeek === 6) {
          Swal.fire('Désolé', 'Le contrôle technique est ouvert du lundi au vendredi de 8h00 à 18h00.', 'error');
          return;
        }
        const timeSlots = getTimeSlotsForDate(info.date, eventList);
        if (timeSlots.length === 0) {
          Swal.fire('Désolé', 'Tous les créneaux sont pris pour cette date.', 'error');
          return;
        }
        const timeOptionsHTML = timeSlots.map(slot => {
          const startTime = slot.start.format('HH:mm');
          const endTime = slot.end.format('HH:mm');
          return `<option value="${startTime}-${endTime}">${startTime}-${endTime}</option>`;
        }).join('');

        const currentDate = moment().startOf('day');

        if (selectedDate.startOf('day').isBefore(currentDate)) {
          Swal.fire('Erreur', 'Vous ne pouvez pas prendre un rendez-vous pour une date passée.', 'error');
          return;
        }

        Swal.fire({
          title: 'Prendre un rendez-vous',
          width: '50em', // Agrandit la largeur de la modale
          padding: '1em', // Largeur personnalisée
          html: `
      <input id="swalTitle" class="swal2-input" placeholder="Nom et prénom">
      <select id="swalTimeSlot" class="swal2-input">${timeOptionsHTML}</select>
    `,
          focusConfirm: false,
          showCancelButton: true,
          cancelButtonColor: "#FFAA11",
          confirmButtonColor: "#0BBF64",
          confirmButtonText: 'Envoyer', // Texte personnalisé pour le bouton de confirmation
          cancelButtonText: 'Quitter', // Texte personnalisé pour le bouton d'annulation
          customClass: {
            confirmButton: 'swal-confirm-button', // Classe personnalisée pour le bouton de confirmation
            cancelButton: 'swal-cancel-button' // Classe personnalisée pour le bouton d'annulation
          },
          preConfirm: () => {
            const title = document.getElementById('swalTitle').value;
            const timeSlot = document.getElementById('swalTimeSlot').value.split('-');
            const chosenDate = selectedDate.format('YYYY-MM-DD');
            return {
              title: title,
              start: `${chosenDate} ${timeSlot[0]}`,
              end: `${chosenDate} ${timeSlot[1]}`,
            };
          }
        }).then(async(result) => {
          if (result.isConfirmed) {
            const { title, start, end } = result.value;

            const formData = new FormData();
            formData.append('start', start);
            formData.append('end', end);
            formData.append('title', title);

            await createEvent(formData, start);
          }
        });
      },
      eventClick: function(info) {
        info.jsEvent.preventDefault();

        const eventId = info.event.id;

      }
    });

    calendar.render();

    adjustCalendarView(); // Appelez la fonction après le rendu initial
  });
});

window.addEventListener('resize', adjustCalendarView); // Ajustez la vue lors du redimensionnement de la fenêtre
