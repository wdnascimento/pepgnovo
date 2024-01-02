<template>
                <audio-recorder class="d-flex"
                        :upload-url="url+'api/preso/audio'"
                        :attempts="1"
                        :time=".5"
                        :successful-upload="sucessUpload"
                        :failed-upload="faliedUpload"
                        />
  </template>

<script>

    export default {
            props: {
                id: Number,
                atendimento_id : Number,
                url : String
            },
            created(){
            },
            methods: {
                sucessUpload(res){
                    this.salvarAtendimento(res.data.data);
                },

                salvarAtendimento(url_audio){
                    axios.post(this.url+"api/atendimento/salvarrespostaatendimento",{
                            
                            atendimento_id : this.atendimento_id,
                            lido : 1,
                            respondido : 1,
                            url_audio_resposta : url_audio,

                    })
                    .then(res=>{
                        Vue.toasted.show("Atendimento salvo com sucesso!!", { 
                            theme: "toasted-primary", 
                            position: "top-right", 
                            duration : 2000
                        });
                    })
                    .catch(function(err){
                            Vue.toasted.show("Erro!!"+err, { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                duration : 2000
                            });
                    })
                },
                faliedUpload(){
                    Vue.toasted.show("Erro ao Carregar Audio!!", { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                },
            }
    }
</script>