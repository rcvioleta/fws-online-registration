<template>
  <!-- <div class="card">
    <div class="card-header">Employees</div>

    <div class="card-body"></div>
  </div>-->
  <div id="employees">
    <div class="form-group">
      <input
        type="text"
        class="form-control"
        placeholder="Filter employees using full name or partial name"
        v-model="search_key"
      >
    </div>

    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">ID Number</th>
          <th scope="col">Full Name</th>
          <th scope="col">Campaign</th>
          <th scope="col">Team</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in filtered_employees" :key="employee.id">
          <td>{{ employee.e_id }}</td>
          <td>{{ employee.full_name }}</td>
          <td>{{ employee.campaign }}</td>
          <td>{{ employee.team }}</td>
          <td>
            <div class="badge badge-success" disabled v-if="employee.status">Active</div>
            <div class="badge badge-danger" disabled v-else>Inactive</div>
          </td>
          <td class="text-center">
            <button class="btn btn-sm btn-warning" @click="editEmployee(employee.id)">Edit</button>
            <button
              class="btn btn-sm btn-danger"
              @click="deactivateEmployee(employee.id)"
              v-if="employee.status"
            >Deactivate</button>
            <button
              class="btn btn-sm btn-success"
              @click="activateEmployee(employee.id)"
              v-else
            >Activate</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employees: [],
      search_key: ""
    };
  },
  created() {
    axios
      .get("/get/employees")
      .then(result => {
        console.log("fetched employees", result.data);
        this.employees = result.data.data;
      })
      .catch(err => console.log(err.response.data));
  },
  methods: {
    editEmployee(id) {
      window.location.href = `/employee/${id}/edit`;
    },
    activateEmployee(id) {
      axios
        .get("/employee/" + id + "/activate")
        .then(response => {
          console.log(response);
          const updatedEmployees = [...this.employees];
          const index = this.employees.findIndex(
            employee => employee.id === id
          );
          updatedEmployees[index].status = 1;
          this.employees = [...updatedEmployees];
        })
        .catch(err => console.log(err));
    },
    deactivateEmployee(id) {
      axios
        .get("/employee/" + id + "/deactivate")
        .then(response => {
          console.log(response);
          const updatedEmployees = [...this.employees];
          const index = this.employees.findIndex(
            employee => employee.id === id
          );
          updatedEmployees[index].status = 0;
          this.employees = [...updatedEmployees];
        })
        .catch(err => console.log(err));
    }
  },
  computed: {
    filtered_employees() {
      return this.employees.filter(employee => {
        return employee.full_name
          .toLowerCase()
          .includes(this.search_key.toLowerCase());
      });
    }
  }
};
</script>
