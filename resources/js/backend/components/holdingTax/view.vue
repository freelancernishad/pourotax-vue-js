<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>

        <div class="breadcrumbs-area">
            <h3>হোল্ডিং ট্যাক্স</h3>
            <ul>
                <li>
                    <router-link :to="{name:'Dashboard'}">ড্যাশবোর্ড</router-link>
                </li>
                <li>হোল্ডিং ট্যাক্স</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">


                        <div class="row">
      <div class="col-12">



        <div class="card">
          <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title">{{ infoModal.content.category+' এর হোল্ডিং ট্যাক্স' }}</h5>
            </div>

<div class="row">





    <div class="col-md-6 col-6 mt-3"><b>হোল্ডিং ট্যাক্স এর ধরণ: </b>{{ infoModal.content.holding_no }}</div>
    <div class="col-md-6 col-6 mt-3"><b>হোল্ডিং নং: </b>{{ infoModal.content.holding_no }}</div>
    <div class="col-md-6 col-6 mt-3"><b>মালিকের নাম: </b>{{ infoModal.content.maliker_name }}</div>
    <div class="col-md-6 col-6 mt-3"><b>পিতা/স্বামীর নাম: </b>{{ infoModal.content.father_or_samir_name }}</div>

    <div class="col-md-6 col-6 mt-3"><b>গ্রামের নাম: </b>{{ infoModal.content.gramer_name }}</div>
    <div class="col-md-6 col-6 mt-3"><b>ওয়াড নং: </b>{{ infoModal.content.word_no }}</div>
    <div class="col-md-6 col-6 mt-3"><b>এনআইডি নং: </b>{{ infoModal.content.nid_no }}</div>
    <div class="col-md-6 col-6 mt-3"><b>মোবাইল নং: </b>{{ infoModal.content.mobile_no }}</div>



    <div class="col-md-12 mt-5 mb-1">
        <h5>হোল্ডিং ট্যাক্স</h5>
    </div>





<div class="col-md-6 col-6 mt-3" v-if="infoModal.content.category=='মালিক নিজে বসবাসকারী' || infoModal.content.category=='আংশিক ভাড়া' || infoModal.content.category=='প্রতিষ্ঠান'"><b>গৃহের বার্ষিক মূল্য: </b>{{ infoModal.content.griher_barsikh_mullo }}</div>



<div class="col-md-6 col-6 mt-3" v-if="infoModal.content.category=='মালিক নিজে বসবাসকারী' || infoModal.content.category=='আংশিক ভাড়া' || infoModal.content.category=='প্রতিষ্ঠান'"><b>জমির ভাড়া: </b>{{ infoModal.content.jomir_vara }}</div>

<div class="col-md-6 col-6 mt-3" v-if="infoModal.content.category=='ভাড়া' || infoModal.content.category=='আংশিক ভাড়া'"><b>বার্ষিক ভাড়ার মূল্য: </b>{{ infoModal.content.barsikh_vara }}</div>









    <div class="col-md-12 col-12 mt-3">

<table class="table">

<thead>
    <tr>
        <th>সাল</th>
        <th>বকেয়া</th>
        <th>অবস্থা</th>
        <th>রশিদ</th>
    </tr>
</thead>

<tbody>

    <tr v-for="bok in infoModal.bokeya">
        <td>{{ bok.year }}</td>
        <td>{{ bok.price }}</td>


        <td v-if="bok.status=='Paid'"><span class="btn btn-success" >পরিশোধিত</span></td>

         <!-- <td v-else><button @click="paynow(bok.id)" class="btn btn-info" >পরিশোধ করুন</button></td> -->
         <td v-else></td>

         <td>

            <a v-if="bok.status=='Paid'" target="_blank" :href="'/holding/tax/certificate_of_honor/'+bok.id" class="btn btn-info" >সম্মাননাপত্র</a>

            <a target="_blank" :href="'/holding/tax/invoice/'+bok.id" class="btn btn-info" >রশিদ</a>

        </td>


    </tr>

    <tr>
        <td>মোট বকেয়া:</td>
        <td>{{ infoModal.content.total_bokeya }}</td>
        <td></td>


    </tr>

</tbody>


</table>


    </div>








</div>




                    </div>
                </div>

            </div>
            </div>
            </div>
            </div>
            </div>
            </div>








            </div>
</template>

    <script>
    export default {
        data(){
            return {
                rows:{},
                buttonLoader:false,
                preLooding:false,
                infoModal: {
                    id: 'info-modal',
                    title: '',
                    content: {

                    },
                    bokeya:{},
                    content_id: '',
                },
            }
        },
        methods: {


        async info() {


            var item = await this.callApi('get',`/api/holding/tax/show/${this.$route.params.id}`);

            this.infoModal.content = item.data
            var res = await this.callApi('get',`/api/holding/bokeya/list?holdingTax_id=${item.data.id}`,[])

            this.infoModal.bokeya = res.data
            this.preLooding = false
        },


        async paynow(id){

            Swal.fire({
                        title: 'Are you sure?',
                        text: `Paid this data!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: `Yes, Paid it!`
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            this.preLooding = true
                            var res  = await this.callApi('post',`/api/holding/bokeya/action?id=${id}`,[]);
                            this.info();

                            Notification.customSuccess(`Your data has been Paid`);


                        }
                    })


        },




        },
        mounted() {
            this.info();
        },
    }
    </script>

<style scoped>
    a.btn.btn-info.btn-lg {
        font-size: 26px;
        margin: 4px;
    }

    </style>
