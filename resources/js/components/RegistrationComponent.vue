<template>
  <!-- <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Registration Component</div>

          <div class="card-body">I'm an example component.</div>
        </div>
      </div>
    </div>
  </div>-->
  <div id="registration">
    <transition
      enter-active-class="animated flipInX"
      leave-active-class="animated flipOutX"
      mode="out-in"
    >
      <div class="card" v-if="show" key="no-reg">
        <div class="card-header">Generate Registration Form</div>

        <div class="card-body">
          <div class="form-group">
            <label for="event">Event</label>
            <select name="event" id="event" class="form-control" @change="generateRegistration">
              <option
                :value="event.id"
                v-for="event in events"
                :key="event.key"
              >{{ event.event_name }}</option>
            </select>
          </div>

          <div class="small">
            <div class="bg-warning p-1">
              <strong>Important Note:</strong>
              Registration form will display once you're done selecting an event.
            </div>
          </div>
        </div>
      </div>

      <div class="card" v-else key="has-reg">
        <div class="card-body">
          <table class="table table-striped table-light">
            <thead>
              <tr>
                <th>ID Number</th>
                <th>Full Name</th>
                <th>Campaign</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="registration in registrations" :key="registration.id">
                <td>{{ registration.e_id }}</td>
                <td>{{ registration.full_name }}</td>
                <td>{{ registration.campaign }}</td>
                <td>{{ registration.status }}</td>
                <td>More on actions later</td>
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
      events: "",
      registrations: ""
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
      axios
        .get("/event/" + event.target.value + "/registration")
        .then(result => {
          this.show = false;
          this.registrations = result.data.data;
          console.log("fetched registration", result);
        })
        .catch(err => console.log(err.response.data));
    }
  }
};
</script>
