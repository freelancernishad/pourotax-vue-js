<template>
<div>
 <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

<div class="breadcrumbs-area">
    <h3>পৌরসভা প্রোফাইল</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">ড্যাশবোর্ড</router-link>
        </li>
        <li>পৌরসভা প্রোফাইল</li>
    </ul>
</div>

  <form @submit.stop.prevent="onSubmit" class="form-horizontal">

      <div class="card-body">

 <div class="row">

  <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার পুরো নাম</label>

                  <input type="text" class="form-control" id="full_name" v-model="form.full_name"  />

          </div>
          </div>



          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার সংক্ষিপ্ত নাম (বাংলা)</label>

                  <input type="text" class="form-control"  id="short_name_b" v-model="form.short_name_b"  />

          </div>
          </div>

          <div class="col-md-6">

          <div class="form-group">
              <label class="control-label col-form-label">উপজেলা (বাংলা)</label>

                  <input type="text" class="form-control"  id="thana" v-model="form.thana"  />

          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">জেলা (বাংলা)</label>

                  <input type="text" class="form-control"  id="district" v-model="form.district"  />

          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">মেয়রের নাম (বাংলা)</label>

                  <input type="text" class="form-control"  id="c_name" v-model="form.c_name"  />

          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">মেয়রের ইমেইল </label>

                  <input type="email" class="form-control"  id="c_email" v-model="form.c_email"  />

          </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-form-label">পৌরসভার কোড (English)</label>

                    <input type="text" class="form-control"  id="u_code" v-model="form.u_code"  />

            </div>
            </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার বিবরন (বাংলা)</label>

              <textarea id="u_description" class="form-control" v-model="form.u_description" cols="30" rows="6" style="resize:none;height:120px"></textarea>

          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার নোটিশ (বাংলা)</label>

                  <textarea id="u_notice" class="form-control"  v-model="form.u_notice" cols="30" rows="6"  style="resize:none;height:120px" ></textarea>

          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার ম্যাপ</label>

                  <textarea id="u_notice" class="form-control"  v-model="form.google_map" cols="30" rows="6"  style="resize:none;height:120px" ></textarea>

          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার কালার</label>

                 <input type="color" id="head" v-model="form.defaultColor" class="form-control" >
          </div>
          </div>



          <div class="col-md-6 d-none">
          <div class="form-group">
              <label class="control-label col-form-label">পেমেন্টের ধরণ</label>

                <select class="form-control" v-model="form.payment_type">
                    <option value="Postpaid">Postpaid</option>
                    <option value="Prepaid">Prepaid</option>

                </select>

          </div>
          </div>



          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">ওয়েবসাইট এর লোগো
              </label>

                  <input type="file" class="form-control" id="web_logo" @change="FileSelected($event, 'web_logo')"  />
                  <label for="web_logo">
             <b-img thumbnail fluid :src="form.web_logo" alt="Image 3"></b-img>
            </label>
          </div>
          </div>




          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">সনদ এর লোগো
              </label>

                  <input type="file" class="form-control" id="sonod_logo"  @change="FileSelected($event, 'sonod_logo')"  />
                  <label for="sonod_logo">
                 <b-img thumbnail fluid :src="form.sonod_logo" alt="Image 3"></b-img>
                </label>
          </div>
          </div>


          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">মেয়রের স্বাক্ষর
              </label>

                  <input type="file" class="form-control" id="c_signture"  @change="FileSelected($event, 'c_signture')"  />
                  <label for="c_signture">
                   <b-img thumbnail fluid :src="form.c_signture" alt="Image 3"></b-img>
                </label>
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
              <label class="control-label col-form-label">পৌরসভার ছবি
              </label>

                  <input type="file" class="form-control" id="u_image"  @change="FileSelected($event, 'u_image')"  />
                  <label for="u_image">
                  <b-img thumbnail fluid :src="form.u_image" alt="Image 3"></b-img>
                </label>
          </div>
          </div>

        </div>



      </div>
      <div class="border-top">
          <div class="card-body">
              <button type="submit" class="btn btn-primary">
                  সাবমিট
              </button>
          </div>
      </div>
  </form>

</div>


</template>



<script>
import axios from 'axios';
export default {
    created() {

    },
    data() {
        return {
             preLooding:true,
             form: {
                full_name:null,
                short_name_e:null,
                domain:null,
                short_name_b:null,
                thana:null,
                district:null,
                web_logo:null,
                sonod_logo:null,
                c_signture:null,
                c_name:null,
                c_email:null,
                u_image:null,
                u_description:null,
                u_notice:null,
                u_code:null,
                contact_email:null,
                google_map:null,
                defaultColor:null,
                payment_type:null,
                status:null,
             },
        }
    },
    methods: {



		FileSelected($event, parent_index){



			let file = $event.target.files[0];
			if (file.size > 5048576) {
				Notification.image_validation();
			} else {
				let reader = new FileReader;
				reader.onload = event => {
					this.form[parent_index] = event.target.result
					// console.log(event.target.result);
				};
				reader.readAsDataURL(file)
			}
                    //   console.log($event.target.result);
		},


       getunionInfo(){
        var unionname = undefined;

                unionname = localStorage.getItem('unioun')

            // var res =  this.callApi('post',`/api/union/info?union=${unionname}`,[]);

                axios.post(`/api/union/info?union=${unionname}`)
                .then((res)=>{
                    // console.log(unionname);
                    // console.log(res);
                    this.form = res.data
                       this.preLooding = false
                })


        },


        async onSubmit() {
            console.log('sdfsdf')
            this.preLooding = true


            var res = await this.callApi('post', '/api/unionprofile/submit', this.form);

            // conseole.log(res)
            this.getunionInfo();
            Notification.customSuccess('পৌরসভা প্রোফাইল সফল ভাবে আপডেট হয়েছে');
            this.preLooding = false


        }
    },
    mounted() {
        this.getunionInfo();
    }
}
</script>
