
let toaster = function(data){
   const prop = {
      text: "I am a toast",
      type: "success",
      class: "card-alert card gradient-45deg-green-teal"
   }
   if((typeof data) === 'object'){
      const cObject = Object.keys(data);
      const objectCount = cObject.length;
      console.log(objectCount);
      for(let x = 0; x < objectCount; x++){
         const index = cObject[x];
         console.log(index);
         if(prop[index]){
            prop[index] = data[index];
         }
      }

   }

   if(prop.type === 'success'){
      prop.class = "card-alert card gradient-45deg-green-teal";
   }else if(prop.type === 'error'){
      prop.class = "card-alert card gradient-45deg-red-pink";
   }

   M.toast({
      html: prop.text,
      classes: prop.class
  })
  
}

const request = {
   post : async function(data){
      let req = await $.post(data.url, data.body).done();
      console.log(req);
      if(req){
         req = JSON.parse(req);
      }
      return req;
   },
   get : async function(data){
      let req = await $.get(data.url, data.body).done();
      if(req){
         req = JSON.parse(req);
      }
      return req;
   }
}

const system = {
   redirect : function(data){
      window.location.href = data;
   }
}