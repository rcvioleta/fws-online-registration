<template>
  <div class="card">
    <div class="card-header">Event/Team Attendance Report</div>
    <div class="card-body">
      <div class="form-group">
        <label for="event">Select specific event statistics</label>
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
            <div class="alert alert-warning">No record to display just yet.</div>
          </template>
        </div>
      </template>
      <div v-show="loading">
        <h4>Please waiting... we are loading the event records.</h4>
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
      loading: false
    };
  },
  methods: {
    lookupStats(event) {
      console.log(event.target.value);
      this.loading = true;
      axios
        .get("/stats/" + event.target.value)
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
