<template>
  <div class="container-fluid">
    <div class="row">
      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Profiles List</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                  <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                  />

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-block btn-primary"
                      data-toggle="modal"
                      data-target="#newModal"
                    >
                      Add New Profile
                      <i class="fas fa-user-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover table-head-fixed">
                <thead>
                  <tr>
                    <th>Account Name</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Group</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="prof in profiles" :key="prof.id">
                    <td>
                      <!-- <router-link :to="'/profiles/' + prof.id">{{ prof.accountname }}</router-link> -->
                      <!--<a data-toggle="modal" data-target="#infoModal">{{ prof.accountname }}</a>-->
                      <strong>{{ prof.accountname }}</strong>
                    </td>
                    <td>{{ prof.bday | properDateFilter }}</td>
                    <td>{{ prof.address }}</td>
                    <td>{{ prof.profilegroup.name }}</td>
                    <td>{{ prof.profiletype.name }}</td>
                    <td>{{ prof.profilestatus.name }}</td>
                    <td>
                      <i class="fa fa-edit"></i>
                      /
                      <i class="fa fa-trash"></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>

    <!-- Profile Info Modal -->
    <div
      class="modal fade"
      id="InfoModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Create Profile Modal -->
    <div
      class="modal fade"
      id="newModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding New Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createProfile">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 ml-auto">
                  <div class="form-group">
                    <small>Account Name</small>
                    <input
                      v-model="form.accountname"
                      type="text"
                      placeholder="Account Name"
                      name="accountname"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('accountname') }"
                    />
                    <has-error :form="form" field="accountname"></has-error>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small>First Name</small>
                    <input
                      v-model="form.fname"
                      type="text"
                      placeholder="First Name"
                      name="fname"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('fname') }"
                    />
                    <has-error :form="form" field="fname"></has-error>
                  </div>
                </div>
                <div class="col-md-6 ml-auto">
                  <div class="form-group">
                    <small>Profile Type</small>
                    <select v-model="form.profiletype_id" class="form-control">
                      <option
                        v-for="proftype in profiletypelist"
                        :key="proftype.id"
                        :value="proftype.id"
                      >{{ proftype.name }}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small>Middle Name</small>
                    <input
                      v-model="form.mname"
                      type="text"
                      placeholder="Middle Name"
                      name="mname"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('mname') }"
                    />
                    <has-error :form="form" field="mname"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small>Profile Group</small>
                    <select v-model="form.profilegroup_id" class="form-control">
                      <option
                        v-for="profgroup in profilegrouplist"
                        :key="profgroup.id"
                        :value="profgroup.id"
                      >{{ profgroup.name }}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small>Last Name</small>
                    <input
                      v-model="form.lname"
                      type="text"
                      placeholder="Last Name"
                      name="lname"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('lname') }"
                    />
                    <has-error :form="form" field="lname"></has-error>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small>Profile Status</small>
                    <select v-model="form.profilestatus_id" class="form-control">
                      <option
                        v-for="profstatus in profilestatuslist"
                        :key="profstatus.id"
                        :value="profstatus.id"
                      >{{ profstatus.name }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small>Address</small>
                    <textarea
                      v-model="form.address"
                      type="text"
                      placeholder="Full Address"
                      name="address"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                    />
                    <has-error :form="form" field="address"></has-error>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small>Birth Date</small>
                    <input
                      v-model="form.bday"
                      type="date"
                      placeholder="Birth Date"
                      name="bday"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('bday') }"
                    />
                    <has-error :form="form" field="bday"></has-error>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      profiles: {},
      profiletypelist: {},
      profilegrouplist: {},
      profilestatuslist: {},
      doing: "",

      form: new Form({
        profiletype_id: 0,
        profilegroup_id: 0,
        profilestatus_id: 0,
        accountname: "",
        address: "",
        bday: "",
        fname: "",
        mname: "",
        lname: ""
      })
    };
  },
  methods: {
    createProfile() {
      this.$Progress.start();
      this.form
        .post("api/profiles")
        .then(() => {
          Toast.fire({
            type: "success",
            title: "New Profile Created!"
          });
          $("#newModal").modal("hide");
          this.$Progress.finish();
          //refresh the list
          //this.loadProfiles();
          //or fire an event
          Eventers.$emit("NewProfileCreated");
        })
        .catch(e => {
          alert(e);
        });
    },
    getProfTypes() {
      axios
        .get("/api/getprofiletypes")
        .then(response => {
          this.profiletypelist = response.data;
        })
        .catch(function(e) {
          alert(e);
        });
    },
    getProfGroups() {
      axios
        .get("/api/getprofilegroups")
        .then(response => {
          this.profilegrouplist = response.data;
        })
        .catch(function(e) {
          alert(e);
        });
    },
    getProfStatus() {
      axios
        .get("/api/getprofilestatus")
        .then(response => {
          this.profilestatuslist = response.data;
        })
        .catch(function(e) {
          alert(e);
        });
    },
    loadProfiles() {
      axios
        .get("/api/profiles")
        .then(({ data }) => (this.profiles = data.data))
        // .then(response => {
        //   this.profiles = response.data;
        // })
        .catch(function(e) {
          alert(e);
        });
    }
  },
  mounted() {
    this.$Progress.start();
    console.log("Component mounted.");
    this.loadProfiles();

    this.getProfTypes();
    this.getProfGroups();
    this.getProfStatus();
    this.$Progress.finish();

    //listen the NewProfileCreated event then refresh the prof list
    Eventers.$on("NewProfileCreated", () => {
      this.loadProfiles();
    });
  }
};
</script>
