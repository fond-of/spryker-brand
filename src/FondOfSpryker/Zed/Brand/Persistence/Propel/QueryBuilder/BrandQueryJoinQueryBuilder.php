<?php

namespace FondOfSpryker\Zed\Brand\Persistence\Propel\QueryBuilder;

use ArrayObject;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Brand\Persistence\Base\FosBrandQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Criterion\CustomCriterion;

class BrandQueryJoinQueryBuilder implements BrandQueryJoinQueryBuilderInterface
{
    /**
     * @var string
     */
    protected const CONCAT = 'CONCAT';

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    public function addQueryFilters(
        FosBrandQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): FosBrandQuery {
        $whereConditionGroups = new ArrayObject();

        foreach ($queryJoinCollectionTransfer->getQueryJoins() as $queryJoinTransfer) {
            $query = $this->processQueryJoin(
                $query,
                $queryJoinTransfer,
                $whereConditionGroups,
            );
        }

        if ($whereConditionGroups->count() === 0) {
            return $query;
        }

        $query->where($whereConditionGroups->getArrayCopy(), Criteria::LOGICAL_AND);

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     * @param \ArrayObject $whereConditionGroups
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function processQueryJoin(
        FosBrandQuery $query,
        QueryJoinTransfer $queryJoinTransfer,
        ArrayObject $whereConditionGroups
    ): FosBrandQuery {
        $query = $this->addJoin($query, $queryJoinTransfer);

        if (count($queryJoinTransfer->getWithColumns()) > 0) {
            $query = $this->addWithColumns(
                $query,
                $queryJoinTransfer->getWithColumns(),
            );
        }

        if ($queryJoinTransfer->getWhereConditions()->count() > 0) {
            $query = $this->addWhereConditionGroup(
                $query,
                $queryJoinTransfer->getWhereConditions(),
                $whereConditionGroups,
            );
        }

        if ($queryJoinTransfer->getOrderBy() !== null) {
            $query->orderBy(
                $queryJoinTransfer->getOrderBy(),
                $queryJoinTransfer->getOrderDirection() ?? Criteria::DESC,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param array<string> $withColumns
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addWithColumns(
        FosBrandQuery $query,
        array $withColumns
    ): FosBrandQuery {
        foreach ($withColumns as $name => $withColumn) {
            $query->withColumn($withColumn, $name);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addJoin(
        FosBrandQuery $query,
        QueryJoinTransfer $queryJoinTransfer
    ): FosBrandQuery {
        if ($queryJoinTransfer->getRelation()) {
            return $this->addRelationJoin($query, $queryJoinTransfer);
        }

        $left = $queryJoinTransfer->getLeft();
        $right = $queryJoinTransfer->getRight();

        if ($left && $right) {
            $query->addJoin(
                $left,
                $right,
                $queryJoinTransfer->getJoinType() ?? Criteria::LEFT_JOIN,
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinTransfer $queryJoinTransfer
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addRelationJoin(
        FosBrandQuery $query,
        QueryJoinTransfer $queryJoinTransfer
    ): FosBrandQuery {
        $query->join(
            $queryJoinTransfer->getRelation(),
            $queryJoinTransfer->getJoinType() ?? Criteria::LEFT_JOIN,
        );

        if ($queryJoinTransfer->getCondition()) {
            $query->addJoinCondition(
                $queryJoinTransfer->getRelation(),
                $queryJoinTransfer->getCondition(),
            );
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \ArrayObject<int, \Generated\Shared\Transfer\QueryWhereConditionTransfer> $queryWhereConditionTransfers
     * @param \ArrayObject $conditionGroups
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addWhereConditionGroup(
        FosBrandQuery $query,
        ArrayObject $queryWhereConditionTransfers,
        ArrayObject $conditionGroups
    ): FosBrandQuery {
        $conditionGroupName = uniqid('', true);

        $conditions = $this->createWhereConditions($query, $queryWhereConditionTransfers);

        if ($conditions) {
            $query->combine(
                $conditions,
                Criteria::LOGICAL_OR,
                $conditionGroupName,
            );

            $conditionGroups->append($conditionGroupName);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     * @param \ArrayObject<int, \Generated\Shared\Transfer\QueryWhereConditionTransfer> $queryWhereConditionTransfers
     *
     * @return array<string>
     */
    protected function createWhereConditions(
        FosBrandQuery $query,
        ArrayObject $queryWhereConditionTransfers
    ): array {
        $conditions = [];

        foreach ($queryWhereConditionTransfers as $queryWhereConditionTransfer) {
            $conditionName = uniqid($queryWhereConditionTransfer->getColumn(), true);
            $query = $this->addConditionToQuery($conditionName, $queryWhereConditionTransfer, $query);

            $combineWithCondition = $queryWhereConditionTransfer->getMergeWithCondition();

            if ($combineWithCondition) {
                $query->combine(
                    [$combineWithCondition, $conditionName],
                    $queryWhereConditionTransfer->getMergeOperator() ?? Criteria::LOGICAL_OR,
                    $combineWithCondition,
                );

                continue;
            }

            $conditions[] = $conditionName;
        }

        return $conditions;
    }

    /**
     * @param string $conditionName
     * @param \Generated\Shared\Transfer\QueryWhereConditionTransfer $queryWhereConditionTransfer
     * @param \Orm\Zed\Brand\Persistence\Base\FosBrandQuery $query
     *
     * @return \Orm\Zed\Brand\Persistence\Base\FosBrandQuery
     */
    protected function addConditionToQuery(
        string $conditionName,
        QueryWhereConditionTransfer $queryWhereConditionTransfer,
        FosBrandQuery $query
    ): FosBrandQuery {
        $column = $queryWhereConditionTransfer->getColumn();
        $value = $queryWhereConditionTransfer->getValue();
        $comparison = $queryWhereConditionTransfer->getComparison() ?? Criteria::LIKE;

        if (mb_strpos($column, static::CONCAT) !== false) {
            return $query->addCond(
                $conditionName,
                new CustomCriterion(new Criteria(), sprintf('%s%s\'%%%s%%\'', $column, $comparison, $value)),
                null,
                Criteria::CUSTOM,
            );
        }

        return $query->addCond(
            $conditionName,
            $column,
            $comparison === Criteria::LIKE ? $this->formatFilterValue($value) : $value,
            $comparison,
        );
    }

    /**
     * @param string|null $value
     *
     * @return string
     */
    protected function formatFilterValue(?string $value): string
    {
        return sprintf('%%%s%%', $value);
    }
}
