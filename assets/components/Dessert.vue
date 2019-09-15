<template>
<div class="row mt-5">
  <div class="col-md-4 col-12 mt-2" v-for="item in items" :key="item.id">
      <div class="card">
        <img src="../img/dessert1.jpg" alt="" class="card-img h-25">
        <div class="card-body">
          <h5 class="card-title">
            {{ item.label }}
            <span class="float-right bg-warning">50 Dhs</span>
          </h5>
          <h6 class="card-subtitle">
            Catégorie: Dessert 
            <span class="float-right">
              <i class="fas fa-star text-warning" v-for="i in item.avis" :key="i"></i>
              <i class="fas fa-star" v-for="j in (5 - item.avis)" :key="j+'vide'"></i>
            </span>
          </h6>
        </div>
      </div>
  </div>
</div>
</template>

<script>
export default {
  name: "dessert",
  data: function(){
    const req = new XMLHttpRequest();
    req.open('GET', 'http://127.0.0.1:8000/menu/Dessert', false);
    req.send(null);
  
    return {
      items: JSON.parse(req.responseText),
    }
  }

};
</script>

<style>
img{
  max-height : 200px;
}
</style>