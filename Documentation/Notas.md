## Notas de Melhorias ##

### Data e Hora do Retorno de Validação ###
Registrar a data e hora de solicitação da
validação do evento com o cliente e data e hora do retorno da validação.
(João)


----------------------------------

[Link para a Base do CNL](https://github.com/EvoluxBR/open-cnl)

## Consulta da base do CNL filtrada.
```sql
select distinct sigla_uf,
                sigla_cnl,
                codigo_cnl,
                nome_da_localidade,
                nome_do_municipio,
                codigo_da_area_de_tarifacao,
                prestadora,
                latitude,
                hemisferio,
                longitude,
                sigla_cnl_da_area_local
           from open_cnl
          where numero_da_faixa_inicial = 0
            and numero_da_faixa_final = 999
            and prestadora = 'CLARO S.A.'
       order by 1,5
```

## Modulo de Auditoria ##
- Controle de registros
- Controle de tempo de uso
