<template>
  <div class="card">
    <div class="card-header">Event/Team Attendance Report</div>
    <div class="card-body">
      <div class="form-group">
        <label for="event">Select specific event report</label>
        <select name="event" id="event" class="form-control" @change="lookupStats">
          <option value disabled selected>-- Select Event --</option>
          <option v-for="event in events" :key="event.id" :value="event.id">{{ event.event_name }}</option>
        </select>
      </div>

      <template v-if="team_stats">
        <div
          class="mt-4"
          :class="{hide: loading}"
          v-for="(team_stat, index) in team_stats"
          :key="index"
        >
          <h4>{{ team_stat.team }}</h4>
          <template v-if="team_stat.attendance_count">
            <div class="progress" style="height: 20px;">
              <div
                class="progress-bar bg-success p-1"
                role="progressbar"
                :style="{width: `${team_stat.attendance_count / team_stat.total_headcount * 100}%`}"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                <span
                  style="font-size: 1.3em;"
                >{{ team_stat.attendance_count }} out of {{ team_stat.total_headcount }}</span>
              </div>
            </div>
          </template>
          <template v-else>
            <div class="progress" style="height: 20px;">
              <div
                class="progress-bar bg-success p-1"
                role="progressbar"
                style="width: 0%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                <span
                  style="font-size: 1.3em;"
                >{{ team_stat.attendance_count }} out of {{ team_stat.total_headcount }}</span>
              </div>
            </div>
          </template>
        </div>
      </template>
      <div v-show="loading">
        <h4>Loading {{ search_event_name }} report.</h4>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["events"],
  data() {
    return {
      team_stats: "",
      loading: false,
      search_event_name: ""
    };
  },
  methods: {
    lookupStats(event) {
      const id = parseInt(event.target.value);
      this.events.filter(event => {
        if (event.id === id) {
          this.search_event_name = event.event_name;
        }
      });
      this.loading = true;

      console.log(event.target.value);
      axios
        .get("/stats/" + id)
        .then(resp => {
          console.log(resp);
          this.team_stats = resp.data;
        })
        .catch(err => console.log(err));
    }
  },
  watch: {
    team_stats() {
      this.loading = false;
    }
  }
};
</script>

<style>
.hide {
  display: none;
}
</style>
