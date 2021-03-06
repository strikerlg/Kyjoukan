<?php

namespace Abienvenu\KyjoukanBundle\Form\Type;

use Abienvenu\KyjoukanBundle\Entity\Pool;
use Abienvenu\KyjoukanBundle\Repository\GroundRepository;
use Abienvenu\KyjoukanBundle\Repository\RoundRepository;
use Abienvenu\KyjoukanBundle\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
	private $pool;

	public function __construct(Pool $pool)
	{
		$this->pool = $pool;
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('team1', EntityType::class, [
				'class' => "KyjoukanBundle:Team",
				'property' => 'name',
				'label' => "Équipe A",
				'query_builder' => function(TeamRepository $repo)
				{
					return $repo->getTeamsForPool($this->pool);
				}
			])
			->add('team2', EntityType::class, [
				'class' => "KyjoukanBundle:Team",
				'property' => 'name',
				'label' => "Équipe B",
				'query_builder' => function(TeamRepository $repo)
				{
					return $repo->getTeamsForPool($this->pool);
				}
			])
			->add('referee', EntityType::class, [
				'class' => "KyjoukanBundle:Team",
				'property' => 'name',
				'label' => "Arbitre",
				'query_builder' => function(TeamRepository $repo)
				{
					return $repo->getTeamsForPhase($this->pool->getPhase());
				}
			])
			->add('ground', EntityType::class, [
				'class' => "KyjoukanBundle:Ground",
				'property' => 'name',
				'label' => "Terrain",
			    'query_builder' => function(GroundRepository $repo)
					{
						return $repo->getGroundsForEvent($this->pool->getPhase()->getEvent());
					}
			])
			->add('round', EntityType::class, [
				'class' => "KyjoukanBundle:Round",
				'property' => 'number',
				'label' => "Tour",
			    'query_builder' => function(RoundRepository $repo)
					{
						return $repo->getRoundsForPhase($this->pool->getPhase());
					}
			])
			->add('score1', IntegerType::class, ['label' => "Score de A", 'required' => false])
			->add('score2', IntegerType::class, ['label' => "Score de B", 'required' => false])
		;
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => 'Abienvenu\KyjoukanBundle\Entity\Game']);
	}
}
