<?php

class AppointmentManager extends AbstractManager
{
    public function create(Appointment $appointment)
    {
        $query = $this->db->prepare("INSERT INTO appointment (User_ID, Service_ID, Appointment_datetime) VALUES (?, ?, ?)");
        $query->execute([
            $appointment->getUserId(),
            $appointment->getServiceId(),
            $appointment->getAppointmentDatetime()
        ]);
        $appointment->setAppointmentId($this->db->lastInsertId());
    }

    public function update(Appointment $appointment)
    {
        $query = $this->db->prepare("UPDATE appointment SET User_ID = ?, Service_ID = ?, Appointment_datetime = ? WHERE Appointment_ID = ?");
        $query->execute([
            $appointment->getUserId(),
            $appointment->getServiceId(),
            $appointment->getAppointmentDatetime(),
            $appointment->getAppointmentId()
        ]);
    }

    public function delete($appointmentId)
    {
        $query = $this->db->prepare("DELETE FROM appointment WHERE Appointment_ID = ?");
        $query->execute([$appointmentId]);
    }

    public function find($appointmentId)
    {
        $query = $this->db->prepare("SELECT * FROM appointment WHERE Appointment_ID = ?");
        $query->execute([$appointmentId]);
        $data = $query->fetch();
        return new Appointment($data['Appointment_ID'], $data['User_ID'], $data['Service_ID'], $data['Appointment_datetime']);
    }

    public function findAll()
    {
        $query = $this->db->query("SELECT * FROM appointment");
        $appointments = [];
        while ($data = $query->fetch()) {
            $appointments[] = new Appointment($data['Appointment_ID'], $data['User_ID'], $data['Service_ID'], $data['Appointment_datetime']);
        }
        return $appointments;
    }
}
