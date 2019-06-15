<template>
  <div id="registration-history">
    <div id="loading-report" v-show="loading">Loading report, please wait...</div>
    <div class="bg-white" v-if="print_mode">
      <table class="table table-bordered" v-show="event_records">
        <thead>
          <tr>
            <th>List Number</th>
            <th>ID Number</th>
            <th>Full Name</th>
            <th>Campaign</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(event_record, index) in event_records" :key="event_record.id">
            <td>{{ index | countingForHumans }}</td>
            <td>{{ event_record.e_id }}</td>
            <td>{{ event_record.full_name }}</td>
            <td>{{ event_record.campaign }}</td>
            <td>
              <span v-if="event_record.status">Registered</span>
              <span v-else>Unregistered</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card" v-else>
      <div class="card-header">Event Registration History</div>
      <div class="card-body">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Event Registration History">
        </div>

        <table class="table table-striped table-light">
          <tbody>
            <tr v-for="event in events" :key="event.id">
              <td>{{ event.event_name }}</td>
              <td>{{ event.date }}</td>
              <td class="text-right">
                <button
                  class="btn-sm btn-primary"
                  @click.prevent="generateReport(event.id)"
                >Generate Report</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["events_prop"],
  data() {
    return {
      events: this.events_prop,
      event_records: "",
      print_mode: false,
      loading: false
    };
  },
  beforeUpdate() {
    console.log("beforeUpdate hook");
  },
  beforeDestroy() {
    console.log("beforeDestroy hook");
  },
  methods: {
    generateReport(id) {
      this.loading = true;
      axios
        .get("/event/" + id + "/registration")
        .then(response => {
          //   console.log("fetched record", response.data);
          if (response.data.length > 0) {
            this.togglePrintMode();
            setTimeout(() => {
              this.event_records = response.data;
              console.log("records loaded");
              this.loading = false;
              //   window.print();
            }, 3000);
          } else {
            alert("No event registration history to generate");
          }
        })
        .catch(err => console.log(err));
    },
    togglePrintMode() {
      this.print_mode = !this.print_mode;
    }
  }
};
</script>

<style>
@media print {
  .card {
    width: 100%;
  }
}
</style>
