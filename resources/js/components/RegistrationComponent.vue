<template>
  <div id="registration">
    <transition
      enter-active-class="animated fadeInUpBig"
      leave-active-class="animated fadeOutDownBig"
      mode="out-in"
    >
      <div class="card" v-if="show" key="no-reg">
        <div class="card-header">Generate Registration Form</div>

        <div class="card-body">
          <h4 v-if="loading">Loading events....</h4>
          <div class="form-group" v-else>
            <label for="event">Event</label>
            <select name="event" id="event" class="form-control" @change="generateRegistration">
              <option value selected disabled>Select an event to start the registration</option>
              <option
                :value="event.id"
                v-for="event in events"
                :key="event.key"
              >{{ event.event_name }}</option>
            </select>
          </div>
          <h4 v-show="generating_report">Generating registration form...</h4>
        </div>
      </div>

      <div class="card" v-else key="has-reg">
        <div class="card-header">Registration Form for {{ selected_event.event_name }}</div>
        <div class="card-body">
          <div class="small bg-warning mb-4 p-1">
            <strong>Important!</strong> Search entries using names to filter result
          </div>
          <form>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                placeholder="Filter record using full name, name keywords..."
                v-model="search_key"
              >
            </div>
          </form>
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th>List Number</th>
                <th>ID Number</th>
                <th>Full Name</th>
                <th>Campaign</th>
                <th>Team</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(filtered_employee, index) in filtered_employees"
                :key="filtered_employee.id"
              >
                <td>{{ index | countingForHumans }}</td>
                <td>{{ filtered_employee.e_id }}</td>
                <td>{{ filtered_employee.full_name }}</td>
                <td>{{ filtered_employee.campaign }}</td>
                <td>{{ filtered_employee.team }}</td>
                <td>
                  <button
                    class="btn-sm btn-success"
                    v-if="filtered_employee.status"
                    disabled
                  >Registered</button>
                  <button
                    class="btn-sm btn-danger"
                    @click="register(filtered_employee.id)"
                    v-else
                  >Unregistered</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: true,
      loading: true,
      generating_report: false,
      events: "",
      registrations: "",
      selected_event: "",
      search_key: ""
    };
  },
  created() {
    axios
      .get("/get-events")
      .then(response => {
        console.table(response.data.data);
        this.events = response.data.data;
      })
      .catch(err => console.log(err));
  },
  methods: {
    generateRegistration(event) {
      const event_id = +event.target.value;
      this.selected_event = this.events.find(event => {
        return event.id === event_id;
      });
      this.generating_report = true;
      axios
        .get("/event/" + event_id + "/registration")
        .then(result => {
          if (result.data.length > 0) {
            this.show = false;
            this.registrations = result.data;
          } else {
            alert(
              "The event that you have selected doesn't have a registration set!"
            );
          }
          console.log("fetched registration", result);
        })
        .catch(err => console.log(err.response.data));
    },
    register(id) {
      axios
        .get("/event/" + id + "/register")
        .then(response => {
          console.log(response);
          const updatedRegistration = [...this.registrations];
          const index = this.registrations.findIndex(
            record => record.id === id
          );
          updatedRegistration[index].status = 1;
          this.registrations = [...updatedRegistration];
        })
        .catch(err => console.log(err));
    }
  },
  computed: {
    filtered_employees() {
      return this.registrations.filter(record => {
        return record.full_name
          .toLowerCase()
          .includes(this.search_key.toLowerCase());
      });
    }
  },
  watch: {
    events() {
      this.loading = false;
    },
    registrations() {
      this.generating_report = false;
    }
  }
};
</script>
