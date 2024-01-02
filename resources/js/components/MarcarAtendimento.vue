<template>
    <div v-if="setores.length" class="row">
            <div  v-for="setor in setores" :key="setor.id" class="col-3 pt-3 w-100">
                <b-button  variant="warning" @click="selecionaSetor(setor.id,setor.titulo)"  class="setor w-100 p-3 h2"> {{setor.titulo}} </b-button>
            </div>
            <div v-if="atendimento.show" class="col-12 p-2">
                <h2  v-if="(atendimento.setor_id != null)" class="w-100 text-center" >
                    Setor <strong>{{atendimento.titulo}}</strong> selecionado.
                </h2>
            </div>
            <div v-if="atendimento.show" class="col-12 p-2 d-flex justify-content-center">
                <audio-recorder class="d-flex"
                        :upload-url="this.url+'/api/preso/audio'"
                        :attempts="1"
                        :time=".5"
                        :successful-upload="sucessUpload"
                        :failed-upload="faliedUpload"/>
            </div>
        </div>
    <div v-else class="col-12">
        <b-alert  show variant="primary" class="text-center">Nenhum Setor Habilitado.</b-alert>
    </div>
</template>

<script>

    export default {
        props: {
             preso: Object,
             url : String
        },
        data(){
            return {
                setores : [],
                preso_id : this.preso.id,
                atendimento: {
                    setor_id : null,
                    titulo: "",
                    show: false,
                },
            }
        },
        created(){
            this.buscarSetores();
        },
        
        methods: {
            buscarSetores(){
                this.limparSetores();

                axios.get(this.url+"/api/setor/listar/"+this.preso_id)
                .then(res => {
                    if(res.data.response == false){
                         Vue.toasted.show(res.data.message, { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                duration : 2000
                            });
                            this.limparSetores();

                    }else{
                        if(res.data.length){
                            this.setores = res.data;
                        }else{
                            Vue.toasted.show("Nenhum setor habilitado para atendimento.", { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                duration : 2000
                            });
                            
                            this.limparSetores();
                        
                        }
                    }
                })
                .catch(function(err){
                    Vue.toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })            
            }, 

            selecionaSetor(id,titulo){
                this.atendimento.setor_id = id;
                this.atendimento.titulo = titulo;
                this.atendimento.show = true;
            },

            limparSetores(){
                this.atendimento.setor_id = null;
                this.atendimento.titulo = "";
                this.setores = [];
                this.atendimento.show = false;
            },

            faliedUpload(){
                Vue.toasted.show("Erro ao Carregar Audio!!", { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            },

            sucessUpload(res){
                this.salvarAtendimento(res.data.data);
            },

            wait(){
                 Vue.toasted.show("Aguarde....", { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            },

            salvarAtendimento(url_audio){
                
                axios.post(this.url+"/api/atendimento/salvaratendimento",{
                    
                        preso_id : this.preso.id,
                        setor_id : this.atendimento.setor_id ,
                        url_audio : url_audio,

                })
                .then(res=>{
                    this.buscarSetores();
                    Vue.toasted.show("Atendimento salvo com sucesso!!", { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                }

                )
               .catch(function(err){
                    Vue.toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })
            },

        }

    }
</script>

<style>

</style>