<?php
$sql = "SELECT * FROM
    (SELECT c.nm_conta,
            c.id_conta,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-01-01' AND '2017-02-01'))
    ) AS janeiro,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-02-01' AND '2017-03-01'))
    ) AS fevereiro,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-03-01' AND '2017-04-01'))
    ) AS marco,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-04-01' AND '2017-05-01'))
    ) AS abril,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-05-01' AND '2017-06-01'))
    ) AS maio,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-06-01' AND '2017-07-01'))
    ) AS junho,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-07-01' AND '2017-08-01'))
    ) AS julho,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-08-01' AND '2017-09-01'))
    ) AS agosto,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-09-01' AND '2017-10-01'))
    ) AS setembro,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-10-01' AND '2017-11-01'))
    ) AS outubro,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-11-01' AND '2017-12-01'))
    ) AS novembro,
    (SELECT es.valor
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-12-01' AND '2018-01-01'))
    ) AS dezembro,
    (SELECT sum(es.valor)
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-01-01' AND '2018-01-01'))
    ) AS total,    
    (SELECT sum(es.valor_pago)
    FROM cashflow.entrada_saida es
    WHERE ((es.id_conta = c.id_conta)
    AND (es.id_carteira = 1)
    AND (es.dt_vencimento BETWEEN '2017-01-01' AND '2018-01-01'))
    ) AS total_pago    
  FROM conta c
  ) t
WHERE ((t.janeiro IS NOT NULL)
OR (t.fevereiro   IS NOT NULL)
OR (t.marco       IS NOT NULL)
OR (t.abril       IS NOT NULL)
OR (t.maio        IS NOT NULL)
OR (t.junho       IS NOT NULL)
OR (t.julho       IS NOT NULL)
OR (t.agosto      IS NOT NULL)
OR (t.setembro    IS NOT NULL)
OR (t.outubro     IS NOT NULL)
OR (t.novembro    IS NOT NULL)
OR (t.dezembro    IS NOT NULL))";
?>